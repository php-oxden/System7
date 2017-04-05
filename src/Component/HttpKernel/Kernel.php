<?php
/*
 * This file is part of the oXylion package.
 *
 * (c) Bartosz Zwierzchowski <vedget@pro-grom.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace System7\Component\HttpKernel;


class Kernel implements TerminableInterface
{


    public function terminate($request = null, $response = null) {
        print "hello";
    }
}