<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Mail\MailableInterface;
use Pollen\Mail\MailManagerInterface;

interface MailProxyInterface
{
    /**
     * Retrieve the mail manager instance|Get a mailable instance if it exists.
     *
     * @param MailableInterface|string|array|null $mailable
     *
     * @return MailManagerInterface|MailableInterface
     */
    public function mail($mailable = null);

    /**
     * Set the mail manager instance.
     *
     * @param MailManagerInterface $mailManager
     *
     * @return void
     */
    public function setMailManager(MailManagerInterface $mailManager): void;
}