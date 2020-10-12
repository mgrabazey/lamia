<?php

namespace Shop\App\Module\Order;

use Shop\App\Module\Order\Calculator\CountryTax;
use Shop\App\Module\Order\Calculator\FineIfSmall;
use Shop\Domain\Exception\BadRequestException;
use Shop\Domain\Validator\OrderValidator;
use Throwable;
use Shop\App\Module\AbstractService;
use Shop\Domain\Order;

class Service extends AbstractService
{
    /**
     * @return Order[]
     */
    public function search(): array
    {
        return $this->container->orderRepository()->search();
    }

    /**
     * @param int $id
     * @return Order
     */
    public function get(int $id): Order
    {
        return $this->container->orderRepository()->get($id);
    }

    /**
     * @param Order $order
     * @throws Throwable
     */
    public function create(Order $order)
    {
        $errors = OrderValidator::validate($order);
        if ($errors) {
            throw new BadRequestException($errors);
        }
        $db = $this->container->databaseService();
        $db->beginTransaction();
        try {
            $orderProductRepository = $this->container->orderProductRepository();
            $orderProductRepository->loadProduct(...$order->getProducts());

            $calc = new Calculator($this->container, $order);
            $calc->attachOnStart(new CountryTax($this->container));
            $calc->attachOnEnd(new FineIfSmall());

            $order->setPrice($calc->calc());
            $this->container->orderRepository()->create($order);
            foreach ($order->getProducts() as $orderProduct) {
                $orderProduct->setOrderId($order->getId());
                $orderProductRepository->create($orderProduct);
            }

            $order->attachOnCreate(new InvoiceSender($this->container));
            $order->notifyOnCreate();
            $db->commit();

        } catch (Throwable $e) {
            $db->rollBack();
            throw $e;
        }
    }
}