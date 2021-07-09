<?php

declare(strict_types=1);

namespace Pollen\Support;

use InvalidArgumentException;
use Throwable;

class Html
{
    /**
     * Double encoding indicator.
     * @var bool
     */
    protected bool $escDoubleEncode = true;

    /**
     * Encoding charset.
     * @var string
     */
    protected string $escEncoding = 'UTF-8';

    /**
     * Encoding flag.
     * @var int
     */
    protected int $escFlags = ENT_QUOTES;

    /**
     * As JSON HTML attribute processing defined in array indicator.
     * @var bool
     */
    protected bool $tagJson = false;

    /**
     * Convert special characters.
     *
     * @param string|bool|array|object $value
     *
     * @return array|bool|int|object|string|null
     */
    public static function e($value)
    {
        if (is_bool($value) || is_numeric($value) || is_null($value)) {
            return $value;
        }

        if (is_string($value)) {
            return (new static())->escape($value);
        }

        if (is_array($value)) {
            return array_map('self::e', $value);
        }

        if (is_object($value)) {
            if ($arrayValue = get_object_vars($value)) {
                return (object)array_map('self::e', $arrayValue);
            }
            return $value;
        }

        throw new InvalidArgumentException('Support HTML unable to escape the passed value type');
    }

    /**
     * Linearization of HTML tag attributes.
     *
     * @param array $attr
     *
     * @return string
     */
    public static function attr(array $attr): string
    {
        return (new static())->tagAttributes($attr);
    }

    /**
     * Convert special characters to HTML entities.
     *
     * @param string $value
     *
     * @return string
     */
    public function escape(string $value): string
    {
        return htmlspecialchars($value ?? '', $this->escFlags, $this->escEncoding, $this->escDoubleEncode);
    }

    /**
     * Formatting HTML Tag Attributes.
     *
     * @param array $attrs
     * @param bool $linearized
     *
     * @return string|array
     */
    public function tagAttributes(array $attrs, bool $linearized = true)
    {
        $attr = [];
        foreach ($attrs as $k => $v) {
            $attr[] = $this->walkAttr($v, $k);
        }

        return $linearized ? implode(' ', $attr) : $attr;
    }

    /**
     * Set double encoding when converting special characters.
     *
     * @param bool $doubleEncode
     *
     * @return $this
     */
    public function setEscapeDoubleEncode(bool $doubleEncode = true): self
    {
        $this->escDoubleEncode = $doubleEncode;

        return $this;
    }

    /**
     * Set the character encoding when converting special characters.
     *
     * @param string $encoding
     *
     * @return $this
     */
    public function setEscapeEncoding(string $encoding = 'UTF-8'): self
    {
        $this->escEncoding = $encoding;

        return $this;
    }

    /**
     * Set the processing bit mask for the conversion of special characters.
     *
     * @param int $flags
     *
     * @return $this
     */
    public function setEscapeFlags(int $flags = ENT_QUOTES): self
    {
        $this->escFlags = $flags;

        return $this;
    }

    /**
     * Set HTML attribute processing defined in array.
     * {@internal to JSON if true, to URL if false.}
     *
     * @param bool $json
     *
     * @return $this
     */
    public function setTagToJson(bool $json = true): self
    {
        $this->tagJson = $json;

        return $this;
    }

    /**
     * Encoding in JSON format.
     * {@internal The return value can be used in JS with JSON.parse({{value}})}
     *
     * @param array $value
     *
     * @return string
     */
    protected function jsonEncode(array $value): string
    {
        try {
            return json_encode($value, JSON_THROW_ON_ERROR);
        } catch(Throwable $e) {
            return '{}';
        }
    }

    /**
     * URL encoding.
     * {@internal The return value can be used in JS with JSON.parse(decodeURIComponent ({{value}})}
     *
     * @param array $value
     *
     * @return string
     */
    protected function urlEncode(array $value): string
    {
        return rawurlencode($this->jsonEncode($value));
    }

    /**
     * Transform an attribute to an HTML attribute.
     *
     * @param string|numeric|array $value
     * @param int|string $key
     *
     * @return string
     */
    protected function walkAttr($value, $key): string
    {
        if (is_array($value)) {
            $value = $this->tagJson ? $this->escape($this->jsonEncode($value)) : $this->urlEncode($value);
        }

        return is_numeric($key) ? (string)$value : "$key=\"$value\"";
    }
}