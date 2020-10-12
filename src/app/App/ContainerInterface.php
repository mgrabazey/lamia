<?php

namespace Shop\App;

use Shop\Domain\Repository\CountryInterface;
use Shop\Domain\Repository\OrderProductInterface;
use Shop\Domain\Repository\OrderInterface;
use Shop\Domain\Repository\ProductInterface;
use Shop\Domain\Repository\TaxInterface;
use Shop\Domain\Service\DatabaseInterface;
use Shop\Domain\Service\MailerInterface;

interface ContainerInterface
{
    /**
     * @return DatabaseInterface
     */
    public function databaseService(): DatabaseInterface;

    /**
     * @return MailerInterface
     */
    public function mailerService(): MailerInterface;

    /**
     * @return CountryInterface
     */
    public function countryRepository(): CountryInterface;

    /**
     * @return ProductInterface
     */
    public function productRepository(): ProductInterface;

    /**
     * @return OrderInterface
     */
    public function orderRepository(): OrderInterface;

    /**
     * @return OrderProductInterface
     */
    public function orderProductRepository(): OrderProductInterface;

    /**
     * @return TaxInterface
     */
    public function taxRepository(): TaxInterface;
}