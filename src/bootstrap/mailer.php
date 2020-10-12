<?php

use Shop\Config\Mailer;
use PHPMailer\PHPMailer\PHPMailer;

$config = Mailer::instance();
$mailer = new PHPMailer(true);
$mailer->isSMTP();
$mailer->Host       = $config->host;
$mailer->SMTPAuth   = true;
$mailer->Username   = $config->user;
$mailer->Password   = $config->pass;
$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailer->Port       = $config->port;
return $mailer;