<?php
/*
 * This file is part of the oXylion package.
 *
 * (c) Bartosz Zwierzchowski <dev@pro-grom.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace System7\Component\HttpFoundation;

class Request
{
    private $htalis;
    private $htbase;
    private $hthost;
    private $request;

    public $c_runtime;

    public function __construct( $c_runtime) {
        $this->c_runtime = $c_runtime;

        $this->hthost = $this->c_runtime['domain'];
        $this->htbase = $_SERVER["SERVER_NAME"];
        $this->request= $_SERVER["REQUEST_URI"];

        $replace = $this->htbase;
        $alias = str_replace($this->hthost, '', $replace);
        echo "new alias: " . $alias . PHP_EOL . PHP_EOL;

        if(null===$alias)
            return false;


        $s_name = $_SERVER['SERVER_NAME'];
        $host = str_replace($alias, '', $s_name);
        echo "new host name: " . $host . PHP_EOL .PHP_EOL;
    }
}