<?php

namespace Shop\App\Module\Order;

use Shop\Domain\Enum\InvoiceFormat;
use Throwable;
use Shop\App\ContainerInterface;
use Shop\Domain\Observer\Order\OrderInterface;
use Shop\Domain\Order;

class InvoiceSender implements OrderInterface
{
    const FROM = 'invoice@shop.com';

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * Mailer constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Order $order
     */
    public function update(Order $order)
    {
        if ($order->getSendToEmail()) {
            try {
                $mailer = $this->container->mailerService();
                $mailer->send(self::FROM, $order->getEmail(), 'Invoice', $this->buildBody($order));

            } catch (Throwable $e) {
                // TODO log error
            };
        }
    }

    /**
     * @param Order $order
     * @return string
     */
    private function buildBody(Order $order): string
    {
        if ($order->getInvoiceFormat() == InvoiceFormat::JSON) {
            $products = [];
            foreach ($order->getProducts() as $product) {
                $products[] = [
                    'id' => $product->getProduct()->getId(),
                    'name' => $product->getProduct()->getName(),
                    'description' => $product->getProduct()->getDescription(),
                    'price' => $product->getProduct()->getPrice(),
                    'tax' => $product->getProduct()->getTax()->getValue(),
                    'count' => $product->getCount(),
                ];
            }
            return '<pre>'.json_encode([
                'id' => $order->getId(),
                'country_code' => $order->getCountryCode(),
                'price' => $order->getPrice(),
                'products' => $products,
            ], JSON_PRETTY_PRINT).'</pre>';
        }
        $body = "";
        $body .= "<div>Order ID: {$order->getId()}</div>";
        $body .= "<div>Country: {$order->getCountryCode()}</div>";
        $body .= "<table width=\"100%\" border=\"1\">";
        $body .= "<caption>Products</caption>";
        $body .= "<thead>";
        $body .= "<tr>";
        $body .= "<td>Name</td>";
        $body .= "<td>Price</td>";
        $body .= "<td>Count</td>";
        $body .= "<td>Tax</td>";
        $body .= "<td>Total</td>";
        $body .= "</tr>";
        $body .= "</thead>";
        foreach ($order->getProducts() as $product) {
            $body .= "<tr>";
            $body .= "<td>{$product->getProduct()->getName()}</td>";
            $body .= "<td>{$product->getProduct()->getPrice()}$</td>";
            $body .= "<td>{$product->getCount()}</td>";
            $body .= "<td>".($product->getProduct()->getTax()->getValue()*100)."%</td>";
            $body .= "<td>".($product->getProduct()->getPrice()*$product->getCount()*(1+$product->getProduct()->getTax()->getValue()))."$</td>";
            $body .= "</tr>";
        }
        $body .= "</table>";
        $body .= "<div>Total Price: {$order->getPrice()}</div>";
        return $body;
    }
}