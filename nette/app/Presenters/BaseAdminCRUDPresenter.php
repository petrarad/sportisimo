<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Form\BaseEntityForm;
use App\UI\Control\SidebarControl;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use JetBrains\PhpStorm\NoReturn;
use Nette;
use Nette\Application\UI\Form;

/**
 * @property Nette\Application\Request $request
 * @property Nette\Application\UI\Template $template
 */
abstract class BaseAdminCRUDPresenter extends BaseAdminPresenter
{
    protected ?object $resource;

    /**
     * @param Form $form
     * @param object $resource
     * @return void
     * @throws Nette\Application\AbortException
     */
    #[NoReturn] public function formSucceeded(Form $form, object $resource): void
    {
        $this->entityManager->persist($resource);
        $this->entityManager->flush();
        $this->flashMessage('Uloženo.');
        $this->redirect('resource', ['id' => $resource->getId()]);
    }

    /**
     * @param int $page
     * @param int $perPage
     * @param string $orderColumn
     * @param bool $orderAscending
     * @return void
     * @throws Nette\Application\BadRequestException
     */
    public function actionCollection(int $page = 1, int $perPage = 5, string $orderColumn = 'name', bool $orderAscending = true): void
    {
        switch ($this->request->getMethod()) {
            case(Nette\Http\IRequest::Get):
                $this->setView('list');
                break;
            case(Nette\Http\IRequest::Post):
            case(Nette\Http\IRequest::Put):
                $this->resource = $this->buildNewResource();
                $this->setView('form');
                break;
            default:
                $this->error('Invalid method', Nette\Http\IResponse::S400_BadRequest);
        }
    }

    abstract protected function buildNewResource(): object;

    /**
     * @param $id
     * @return void
     * @throws Nette\Application\AbortException
     * @throws Nette\Application\BadRequestException
     */
    public function actionResource($id): void
    {
        $resource = $this->getRepository()->find($id);
        if (!$resource) {
            $this->error('Resource was not found', Nette\Http\IResponse::S404_NotFound);
        }
        $this->resource = $resource;
        $method = $this->request->getMethod();
        if ($method === Nette\Http\IRequest::Post && $this->request->getPost('method') === Nette\Http\IRequest::Delete) {
            // method DELETE is not supported in HTML? https://www.w3.org/TR/2010/WD-html5-diff-20101019/#changes-2010-06-24
            $method = Nette\Http\IRequest::Delete;
        }
        switch ($method) {
            case(Nette\Http\IRequest::Post):
                $this->setView('form');
                break;
            case(Nette\Http\IRequest::Get):
                $this->setView('show');
                break;
            case(Nette\Http\IRequest::Delete):
                $this->entityManager->remove($resource);
                $this->entityManager->flush();
                $this->flashMessage('Smazáno.');
                $this->redirect('collection');
            default:
                $this->error('Invalid method', Nette\Http\IResponse::S400_BadRequest);
        }
    }

    abstract protected function getRepository(): EntityRepository;

    public function renderShow(): void
    {
        $this->template->resource = $this->getResource();
    }

    protected function getResource(): object
    {
        return $this->resource;
    }

    public function renderForm(): void
    {
        $this->template->resource = $this->getResource();
    }

    public function renderList(int $page = 1, int $perPage = 5, string $orderColumn = 'name', bool $orderAscending = true): void
    {
        $count = (int)$this->getRepository()->createQueryBuilder('a')->select('COUNT(a.id)')->getQuery()->getSingleScalarResult();

        $paginator = new Nette\Utils\Paginator;
        $paginator->setItemCount($count);
        $paginator->setItemsPerPage($perPage);
        $paginator->setPage($page);

        $orderBy = $this->resolveOrderBy($orderColumn, $orderAscending);
        $results = $this->getRepository()->findBy([], $orderBy, $paginator->getLength(), $paginator->getOffset());

        $this->template->orderColumn = $orderColumn;
        $this->template->orderAscending = $orderAscending;
        $this->template->paginator = $paginator;
        $this->template->results = $results;
    }

    abstract protected function buildForm(): BaseEntityForm;

    protected function createComponentForm(): Form
    {
        $form = $this->buildForm();
        $form->configure($this->getResource(), [$this, 'formSucceeded']);
        return $form;
    }

    abstract protected function resolveOrderBy(string $orderColumn, bool $orderAscending): array;
}