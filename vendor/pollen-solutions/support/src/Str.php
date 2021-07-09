<?php

declare(strict_types=1);

namespace Pollen\Support;

use Error;
use Illuminate\Support\Str as BaseStr;
use Pollen\Validation\Validator as v;

class Str extends BaseStr
{
    /**
     * Create an excerpt of a character string.
     *
     * @param string $string
     * @param int $length
     * @param string $teaser
     * @param boolean $use_tag
     * @param boolean $uncut
     *
     * @return string
     */
    public static function teaser(
        string $string,
        int $length = 255,
        string $teaser = ' [&hellip;]',
        bool $use_tag = true,
        bool $uncut = true
    ): string {
        if ($use_tag && preg_match('/<!--more(.*?)?-->/', $string, $matches)) {
            $strings = preg_split('/<!--more(.*?)?-->/', $string);
            $teased = str_replace(']]>', ']]&gt;', $strings[0]);
            $teased = strip_tags($teased);
            $teased = trim($teased);

            if ($length > strlen($teased)) {
                return $teased . $teaser;
            }
            $string = $teased;
        } else {
            $string = str_replace(']]>', ']]&gt;', $string);
            $string = strip_tags($string);
            $string = trim($string);

            if ($length > strlen($string)) {
                return $string;
            }
        }

        if ($uncut) {
            $string = substr($string, 0, $length);
            $pos = strrpos($string, " ");

            if ($pos === false) {
                return substr($string, 0, $length) . $teaser;
            }

            return substr($string, 0, $pos) . $teaser;
        }
        return substr($string, 0, $length) . $teaser;
    }

    /**
     * Textarea field text compatibility.
     *
     * @param string $text
     *
     * @return string
     */
    public static function br2nl(string $text): string
    {
        return preg_replace(
            '/<br\s?\/?>/ius',
            "\n",
            str_replace(
                "\n",
                "",
                str_replace("\r", "", htmlspecialchars_decode($text))
            )
        );
    }

    /**
     * Auto-close unclosed HTML tags.
     *
     * @param $html
     *
     * @return string
     *
     * @see https://gist.github.com/JayWood/348752b568ecd63ae5ce
     */
    public static function closeTags($html): string
    {
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);

        $closedtags = $result[1];
        $len_opened = count($openedtags);

        if (count($closedtags) == $len_opened) {
            return $html;
        }

        $openedtags = array_reverse($openedtags);

        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</' . $openedtags[$i] . '>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

    /**
     * Converts environment variables from a character string or a list of character string.
     *
     * @param string|string[] $output
     * @param array $vars
     * @param string $pattern
     *
     * @return string|string[]|null
     */
    public static function mergeVars($output, array $vars = [], string $pattern = "/\*\|(.*?)\|\*/")
    {
        $callback = function ($matches) use ($vars) {
            if (!isset($matches[1])) {
                return $matches[0];
            }

            if (isset($vars[$matches[1]])) {
                return $vars[$matches[1]];
            }

            return $matches[0];
        };

        return preg_replace_callback($pattern, $callback, $output);
    }

    /**
     * Unserialize a character string.
     *
     * @param string $value
     *
     * @return mixed
     */
    public static function unserialize(string $value)
    {
        if (v::serialized()->validate($value)) {
            try {
                $unserialized = @unserialize($value, ['allowed_classes' => true]);
            } catch(Error $e) {
                return $value;
            }

            return ($unserialized !== false) ? $unserialized : $value;
        }

        return $value;
    }
}