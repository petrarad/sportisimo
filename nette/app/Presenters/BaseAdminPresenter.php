<?php

declare(strict_types=1);

namespace App\Presenters;

use App\UI\Control\SidebarControl;
use Doctrine\ORM\EntityManagerInterface;
use Nette;

/**
 * @property Nette\Application\Request $request
 * @property Nette\Application\UI\Template $template
 */
abstract class BaseAdminPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        protected EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    public function beforeRender()
    {
        $this->template->sidebarToggled = $this->getHttpRequest()->getCookie('sidebar');
    }

    protected function createComponentSidebar(): SidebarControl
    {
        return new SidebarControl();
    }
}