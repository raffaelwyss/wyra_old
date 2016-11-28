<?php

namespace Wyra\Kernel\View;

use Smarty;
use Wyra\Kernel\Kernel;

/**
 * View of WyRa
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
class ViewSMARTY extends View
{

    /** @var null|Smarty $smarty */
    private $smarty = null;


    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->setUpSmarty();
    }


    /**
     * Gibt die Daten vom HTML aus
     *
     * @param $data
     */
    public function show($data, $args = [], $echo = true)
    {
        $return = $data;
        if ($echo) {
            $this->addContent($args['template'], $data, $args);
            //$this->smarty->assign('content', 'xyz');
            $this->smarty->display(Kernel::$config->get('rootPath').'/Plugin/Base/Template/markup.tpl');
        }
        return $return;
    }

    private function addContent($template, $data, $args)
    {
        $this->smarty->assign('content', $this->smarty->fetch($this->getTemplate($template, $args)));
    }


    private function getTemplate($template, $args)
    {
        return Kernel::$config->get('rootPath').'/Plugin/'.$args['Plugin'].'/Template/'.$template;
    }


    private function setUpSmarty()
    {
        // Setzen der Template-Einstellungen
        $path = Kernel::$config->get('rootPath')."/Kernel/View/Smarty";
        $this->smarty->setTemplateDir($path . '/templates/');
        $this->smarty->setCompileDir($path . '/templates_c/');
        $this->smarty->setConfigDir($path . '/configs/');
        $this->smarty->setCacheDir($path . '/cache/');

        // Allgemeines setzen
        $this->smarty->caching = Smarty::CACHING_OFF;
        $this->smarty->debugging = false;
    }




}