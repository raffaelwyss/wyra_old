<?php

namespace Wyra\Kernel;

use Wyra\Kernel\PHP\GET;
use Wyra\Kernel\PHP\POST;
use Wyra\Kernel\PHP\SESSION;

/**
 * Kernel of WyRa
 *
 * Copyright (c) 2016, Raffael Wyss <raffael.wyss@gmail.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Raffael Wyss nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @autor       Raffael Wyss <raffael.wyss@gmail.com>
 * @copyright   2016 Raffael Wyss. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD License
 */
class Kernel
{
    /** @var null|GET */
    public static $get = null;

    /** @var null|POST */
    public static $post = null;

    /** @var null|SESSION */
    public static $session = null;

    /** @var null|Crypt */
    public static $crypt = null;

    /** @var null|Config */
    public static $config = null;

    /** @var null|Language */
    public static $language = null;
    
    public function start()
    {
        // Session Start
        session_start();

        // Initialize Exception & Error-Handler
        set_error_handler(array(new Error(), 'handler'));
        set_exception_handler(array( new Exception(), 'handler'));

        // Initialize Language
        self::$language = new Language();

        // Load the Parameters & Variables
        self::$get = new GET();
        self::$post = new POST();
        self::$session = new SESSION();

        // Initialize Config
        self::$config = new Config();

        // Initialize The Crypter
        self::$crypt = new Crypt();

        // Start the Routing
        $route = new Route();
        $route->route();
    }
}