<?php
/*
 * This file is part of the oXylion package.
 *
 * (c) Bartosz Zwierzchowski <vedget@pro-grom.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('_print')) {
    function _print($content)
    {
        if (is_array($content) or is_object($content)) {
            print ("<pre>");
            print_r($content);
            print ("</pre>");
        } else {
            print ($content);
        }
    }
} // end_of_if

if (!function_exists('self_exists')) {
    function self_localize()
    {
        echo dirname(__FILE__);
    }
} // end_of_if
