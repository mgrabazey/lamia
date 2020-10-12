<?php

namespace Shop\App\Module\Order;

use Shop\App\Module\Order\Calculator\CountryTax;
use Shop\App\Module\Order\Calculator\FineIfSmall;
use Throwable;
use Shop\App\Module\AbstractService;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;

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
     * @param OrderProduct ...$orderProducts
     * @throws Throwable
     */
    public function create(Order $order, OrderProduct ...$orderProducts)
    {
        $db = $this->container->databaseService();
        $db->beginTransaction();
        try {
            $calc = new Calculator($this->container, $order, ...$orderProducts);
            $calc->attachOnStart(new CountryTax($this->container));
            $calc->attachOnEnd(new FineIfSmall());

            $order->setPrice($calc->calc());
            $this->container->orderRepository()->create($order);
            foreach ($orderProducts as $orderProduct) {
                $orderProduct->setOrderId($order->getId());
                $this->container->orderProductRepository()->create($orderProduct);
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