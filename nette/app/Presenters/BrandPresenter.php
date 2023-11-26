<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\BrandForm;
use App\Model\Database\Brand;
use App\Model\Form\BaseEntityForm;
use Doctrine\ORM\EntityRepository;

final class BrandPresenter extends BaseAdminCRUDPresenter
{
    protected function buildNewResource(): object
    {
        return new Brand();
    }


    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Brand::class);
    }

    protected function buildForm(): BaseEntityForm
    {
        return new BrandForm();
    }

    protected function resolveOrderBy(string $orderColumn, bool $orderAscending): array
    {
        if(!in_array($orderColumn, ['name'],true)) { // more properties?
            $orderColumn = 'name';
        }
        return [$orderColumn => $orderAscending ? 'ASC' : 'DESC'];
    }
}
