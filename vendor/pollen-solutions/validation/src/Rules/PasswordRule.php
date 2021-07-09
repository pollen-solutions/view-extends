<?php

declare(strict_types=1);

namespace Pollen\Validation\Rules;

use Pollen\Validation\ValidationRuleInterface;
use Respect\Validation\Rules\Length;
use Respect\Validation\Rules\Regex;
use Respect\Validation\Exceptions\ComponentException;

class PasswordRule extends AbstractRule
{
    /**
     * Number of digits required.
     * @var int
     */
    protected int $digit = 1;

    /**
     * Number of lower case letters required.
     * @var int
     */
    protected int $lower = 1;

    /**
     * Maximum number of characters.
     * @var int
     */
    protected int $max = 0;

    /**
     * Minimum number of characters.
     * @var int
     */
    protected int $min = 8;

    /**
     * Number of special characters required.
     * @var int
     */
    protected int $special = 0;

    /**
     * Number of uppercase letters required.
     * @var int
     */
    protected int $upper = 1;

    /**
     * @inheritDoc
     */
    public function setArgs(...$args): ValidationRuleInterface
    {
        $args = array_merge(
            $defaults = [
                'digit'   => 1,
                'lower'   => 1,
                'max'     => 16,
                'min'     => 8,
                'special' => 0,
                'upper'   => 1,
            ],
            $args[0] ?? []
        );

        foreach ($args as $k => $v) {
            if (array_key_exists($k, $defaults)) {
                $this->{$k} = (int)$v;
            }
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function validate($input): bool
    {
        try {
            if ($this->min > 0 && !(new Length($this->min))->validate($input)) {
                return false;
            }

            if ($this->max > 0 && !(new Length(null, $this->max))->validate($input)) {
                return false;
            }

            $regex = "";

            if ($this->digit) {
                $regex .= "(?=(?:.*\d){" . $this->digit . ",})";
            }

            if ($this->lower) {
                $regex .= "(?=(?:.*[a-z]){" . $this->lower . ",})";
            }

            if ($this->upper) {
                $regex .= "(?=(?:.*[A-Z]){" . $this->upper . ",})";
            }

            if ($this->special) {
                $regex .= "(?=(?:.*[!@#$%^&*()\[\]\-_=+{};:,<.>]){" . $this->special . ",})";
            }

            return (new Regex('/' . $regex . '/'))->validate($input);
        } catch (ComponentException $e) {
            return false;
        }
    }
}