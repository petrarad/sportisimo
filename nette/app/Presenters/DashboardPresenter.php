<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Form\BrandForm;
use App\Model\Database\Brand;
use App\Model\Database\Product;
use App\Model\Form\BaseEntityForm;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

final class DashboardPresenter extends BaseAdminPresenter {
    public function actionDashboard(): void
    {}
    public function renderDashboard(): void
    {
        $this->template->counts = [
            'brand' => $this->getCount(Brand::class),
            'product' => $this->getCount(Product::class),
        ];
    }

    protected function getCount(string $entity): int
    {
        try {
            return (int)$this->entityManager
                ->getRepository($entity)
                ->createQueryBuilder('r')
                ->select('COUNT(r.id)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException|NonUniqueResultException $e) {
            return 0;
        }
    }
}