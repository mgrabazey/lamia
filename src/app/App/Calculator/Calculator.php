<?php

namespace Shop\App\Calculator;

use Shop\App\ContainerInterface;
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
     * @var StartObserverInterface[]
     */
    private array $onStartObservers = [];

    /**
     * @var EndObserverInterface[]
     */
    private array $onEndObservers = [];

    /**
     * @var float
     */
    private float $price = 0;

    /**
     * @var StartObserverProduct[]
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
                new StartObserverProduct($product, $orderProductsMap[$product->getId()]),
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
     * @param StartObserverInterface $observer
     */
    public function attachOnStart(StartObserverInterface $observer)
    {
        $this->onStartObservers[] = $observer;
    }

    /**
     * @param EndObserverInterface $observer
     */
    public function attachOnEnd(EndObserverInterface $observer)
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