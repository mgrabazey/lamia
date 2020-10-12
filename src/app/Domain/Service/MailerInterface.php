<?php

namespace Shop\Domain\Service;

interface MailerInterface
{
    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public function send(string $from, string $to, string $subject, string $body): bool;
}