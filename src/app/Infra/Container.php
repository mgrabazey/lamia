<?php

namespace Shop\Infra;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use Shop\App\ContainerInterface;
use Shop\Domain\Repository\CountryInterface;
use Shop\Domain\Repository\OrderProductInterface;
use Shop\Domain\Repository\OrderInterface;
use Shop\Domain\Repository\ProductInterface;
use Shop\Domain\Repository\TaxInterface;
use Shop\Domain\Service\DatabaseInterface;
use Shop\Domain\Service\MailerInterface;
use Shop\Infra\Db\MySql\Database;
use Shop\Infra\Db\MySql\Repository\CountryRepository;
use Shop\Infra\Db\MySql\Repository\OrderProductRepository;
use Shop\Infra\Db\MySql\Repository\OrderRepository;
use Shop\Infra\Db\MySql\Repository\ProductRepository;
use Shop\Infra\Db\MySql\Repository\TaxRepository;

class Container implements ContainerInterface
{
    /**
     * @var PDO
     */
    private PDO $database;

    /**
     * @var PHPMailer
     */
    private PHPMailer $mailer;

    /**
     * Container constructor.
     * @param PDO $database
     * @param PHPMailer $mailer
     */
    public function __construct(PDO $database, PHPMailer $mailer)
    {
        $this->database = $database;
        $this->mailer = $mailer;
    }

    /**
     * @inheritdoc
     */
    public function databaseService(): DatabaseInterface
    {
        return new Database($this->database);
    }

    /**
     * @inheritdoc
     */
    public function mailerService(): MailerInterface
    {
        return new Mailer($this->mailer);
    }

    /**
     * @inheritdoc
     */
    public function countryRepository(): CountryInterface
    {
        return new CountryRepository($this->database);
    }

    /**
     * @inheritdoc
     */
    public function productRepository(): ProductInterface
    {
        return new ProductRepository($this->database);
    }

    /**
     * @inheritdoc
     */
    public function orderRepository(): OrderInterface
    {
        return new OrderRepository($this->database);
    }

    /**
     * @inheritdoc
     */
    public function orderProductRepository(): OrderProductInterface
    {
        return new OrderProductRepository($this->database);
    }

    /**
     * @inheritdoc
     */
    public function taxRepository(): TaxInterface
    {
        return new TaxRepository($this->database);
    }
}