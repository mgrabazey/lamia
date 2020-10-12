<?php

namespace Shop\App\Module\Order;

use Throwable;
use PHPMailer\PHPMailer\PHPMailer;
use Shop\App\ContainerInterface;
use Shop\Domain\Observer\Order\OrderInterface;
use Shop\Domain\Order;

class InvoiceSender implements OrderInterface
{
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
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function update(Order $order)
    {
        if (!$order->getSendToEmail()) {
            return;
        }
        try {
            $mailer = new PHPMailer(true);
            $mailer->isSMTP();
            $mailer->Host       = 'smtp.gmail.com';
            $mailer->SMTPAuth   = true;
            $mailer->Username   = 'mgrabazey@gmail.com';
            $mailer->Password   = 'Deserteagle860';
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port       = 587;

            $mailer->setFrom('invoice@shop.com');
            $mailer->addAddress($order->getEmail());
            $mailer->Subject = 'Invoice';
            $mailer->Body = $order->getPrice();
            $mailer->send();

        } catch (Throwable $e) {
            // TODO log error
        }
    }
}