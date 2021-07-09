<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Pollen\Form\FormInterface;
use Pollen\Form\FormManagerInterface;

interface FormProxyInterface
{
    /**
     * Retrieve the form manager instance|Get the form instance if it exists.
     *
     * @param string|null $alias
     *
     * @return FormManagerInterface|FormInterface
     */
    public function form(?string $alias = null);

    /**
     * Set the form manager instance.
     *
     * @param FormManagerInterface $formManager
     *
     * @return void
     */
    public function setFormManager(FormManagerInterface $formManager): void;
}