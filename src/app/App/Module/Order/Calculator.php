<?php

namespace Shop\App\Module\Order;

use Shop\App\ContainerInterface;
use Shop\Domain\Observer\Price\EndInterface;
use Shop\Domain\Observer\Price\StartInterface;
use Shop\Domain\Observer\Price\StartProduct;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;
use Shop\Domain\Product;

class Calculator
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @var Order
     */
    private Order $order;

    /**
     * @var OrderProduct[]
     */
    private array $orderProducts;

    /**
     * @var StartInterface[]
     */
    private array $onStartObservers = [];

    /**
     * @var EndInterface[]
     */
    private array $onEndObservers = [];

    /**
     * @var float
     */
    private float $price = 0;

    /**
     * @var StartProduct[]
     */
    private array $products;

    /**
     * Calculator constructor.
     * @param ContainerInterface $container
     * @param Order $order
     * @param OrderProduct ...$orderProducts
     */
    public function __construct(ContainerInterface $container, Order $order, OrderProduct ...$orderProducts)
    {
        $this->container = $container;
        $this->order = $order;
        $this->orderProducts = $orderProducts;
    }

    /**
     * @return float
     */
    public function calc(): float
    {
        $orderProductsMap = [];
        foreach ($this->orderProducts as $orderProduct) {
            $orderProductsMap[$orderProduct->getProductId()] = $orderProduct;
        }
        $products = $this->container->productRepository()->getByIds(
            array_map(fn(OrderProduct $product) => $product->getProductId(), $this->orderProducts)
        );
        $this->products = array_map(
            fn(Product $product) =>
                new StartProduct($product, $orderProductsMap[$product->getId()]),
            $products
        );
        $this->notifyOnStart();
        foreach ($this->products as $product) {
            $this->price += $product->getPrice()*$product->getCount();
        }
        $this->notifyOnEnd();
        return $this->price;
    }

    /**
     * @param StartInterface $observer
     */
    public function attachOnStart(StartInterface $observer)
    {
        $this->onStartObservers[] = $observer;
    }

    /**
     * @param EndInterface $observer
     */
    public function attachOnEnd(EndInterface $observer)
    {
        $this->onEndObservers[] = $observer;
    }

    private function notifyOnStart()
    {
        foreach ($this->onStartObservers as $observer) {
            $observer->update($this->order->getCountryCode(), ...$this->products);
        }
    }

    private function notifyOnEnd()
    {
        foreach ($this->onEndObservers as $observer) {
            $observer->update($this->price);
        }
    }
}