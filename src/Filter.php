<?php
namespace System7;
/**
 * @name    Pro -Grom HomePage
 * @link    http://www.pro-grom.pl/
 * @author  Bartosz Zwierzchowski, <dev@pro-grom.pl>
 * @license http://www.opensource.org/licenses/mit/ MIT License
 * @copyright (c) 2017 Bartosz Zwierzchowski
 */


class Filter
{
    /**
     * filtr data about xss
     *
     * @param string $str data to filtr
     * @return string
     */
    public static function xss($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    /**
     * filtr data about bad utf8
     *
     * @param string $str data to filtr
     * @return string
     */
    public static function utf8($str) {
        return @iconv("utf-8", "utf-8//IGNORE", $str);
    }

}