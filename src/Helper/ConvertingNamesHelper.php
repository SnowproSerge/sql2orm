<?php
/**
 * @author: Sergey Naryshkin
 * @date: 22.03.2018
 */

namespace SnowSerge\Sql2Orm\Helper;


class ConvertingNamesHelper
{
    /**
     * Convert name from snake notification to camel
     *
     * @param $name
     * @param bool $firstUpper is first letter in uppercase
     * @return string
     */
    public static function snakeToCamel($name,$firstUpper = false) :string
    {
        $tmp = preg_replace_callback(
            '/^([^-_]+)/',
            function ($world) {
                return strtolower($world[1]);
            },
            $name
        );
        $regexp = $firstUpper ? '/[-_]*([^-_]+)/' : '/[-_]+([^-_]+)/' ;
        return preg_replace_callback(
            $regexp,
            function ($world) {
                return ucwords(strtolower($world[1]));
            },
            $tmp
        );
    }
}