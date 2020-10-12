<?php

namespace Shop\Infra;

use PHPMailer\PHPMailer\PHPMailer;
use Shop\Domain\Service\MailerInterface;

class Mailer implements MailerInterface
{
    /**
     * @var PHPMailer
     */
    private PHPMailer $driver;

    /**
     * Mailer constructor.
     * @param PHPMailer $driver
     */
    public function __construct(PHPMailer $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @inheritdoc
     */
    public function send(string $from, string $to, string $subject, string $body): bool
    {
        $driver = clone $this->driver;
        $driver->setFrom($from);
        $driver->addAddress($to);
        $driver->Subject = $subject;
        $driver->Body = $body;
        return $driver->send();
    }
}