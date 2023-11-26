<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\ProductForm;
use App\Model\Database\Product;
use App\Model\Form\BaseEntityForm;
use Doctrine\ORM\EntityRepository;

final class ProductPresenter extends BaseAdminCRUDPresenter
{
    protected function buildNewResource(): object
    {
        return new Product();
    }

    protected function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Product::class);
    }

    protected function buildForm(): BaseEntityForm
    {
        return new ProductForm($this->entityManager);
    }

    protected function resolveOrderBy(string $orderColumn, bool $orderAscending): array
    {
        if(!in_array($orderColumn, ['name', 'price'],true)) {
            $orderColumn = 'name';
        }
        return [$orderColumn => $orderAscending ? 'ASC' : 'DESC'];
    }
}
