<?php

namespace App\UI\Control;

use Nette\Application\UI\Control;
use Nette\Http\RequestFactory;

class SidebarControl extends Control {
    public function render():void
    {
        $this->template->render(__DIR__ . '/templates/sidebar.latte');
    }
}