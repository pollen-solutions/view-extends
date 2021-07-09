<?php

declare(strict_types=1);

namespace Pollen\Validation\Rules;

use Pollen\Validation\ValidationRuleInterface;

class SerializedRule extends AbstractRule
{
    /**
     * Verification mode.
     * @var bool $strict
     */
    protected bool $strict = true;

    /**
     * @inheritDoc
     */
    public function setArgs(...$args): ValidationRuleInterface
    {
        $this->strict = (bool) ($args[0] ?? true);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        $input = trim($input);
        if ('N;' === $input) {
            return true;
        }

        if (strlen($input) < 4) {
            return false;
        }

        if (':' !== $input[1]) {
            return false;
        }

        if ($this->strict) {
            $lastc = substr($input, -1);
            if (';' !== $lastc && '}' !== $lastc) {
                return false;
            }
        } else {
            $semicolon = strpos($input, ';');
            $brace = strpos($input, '}');

            if (false === $semicolon && false === $brace) {
                return false;
            }

            if (false !== $semicolon && $semicolon < 3) {
                return false;
            }

            if (false !== $brace && $brace < 4) {
                return false;
            }
        }

        $token = $input[0];
        switch ($token) {
            case 's':
                if ($this->strict) {
                    if ('"' !== $input[strlen($input) - 2]) {
                        return false;
                    }
                } elseif (false === strpos($input, '"')) {
                    return false;
                }
                break;
            case 'a':
            case 'O':
                return (bool)preg_match("/^$token:[0-9]+:/s", $input);
            case 'b':
            case 'i':
            case 'd':
                $end = $this->strict ? '$' : '';
                return (bool)preg_match("/^$token:[0-9.E-]+;$end/", $input);
        }

        return false;
    }
}