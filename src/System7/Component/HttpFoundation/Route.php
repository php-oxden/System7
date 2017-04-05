<?php
/*
 * This file is part of the oXylion package.
 *
 * (c) Bartosz Zwierzchowski <vedget@pro-grom.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace System7\Component\HttpFoundation;


class Route
{
    private $_uri = array();

    /**
     * Builds a collection of internal url's to look for
     * @param string $uri
     */
    public function add($uri) {
        $this->_uri[] = $uri;
    }
}