<?php

namespace App\Form;

use App\Model\Database\Brand;
use App\Model\Database\Product;
use App\Model\Form\BaseEntityForm;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Nette;
use Nette\Forms\Form;

class ProductForm extends BaseEntityForm {
    public function __construct(
        protected EntityManagerInterface $entityManager,
        ?Nette\ComponentModel\IContainer $parent = null,
        ?string $name = null
    )
    {
        parent::__construct($parent, $name);
    }


    protected function configureForm(object $entity): void
    {
        /** @var Product $entity */
        $this
            ->addText('name', 'Název')
            ->setRequired()
            ->setDefaultValue($this->tryToGet($entity, 'name', ''))
        ;
        $this
            ->addInteger('price', 'Cena')
            ->setRequired()
            ->addRule(Form::Min, 'Cena nesmí být nižší než %d', 0)
            ->setDefaultValue($this->tryToGet($entity, 'price'))
        ;
        $this
            ->addSelect('brand', 'Značka', $this->getBrandOptions())
            ->setRequired()
            ->setDefaultValue($this->tryToGet($entity, 'brand')?->getId())
        ;
        $this
            ->addSubmit('send', 'Uložit')
            ->setHtmlAttribute('class', 'btn')
        ;
    }

    protected function bindData(array $formData, object $entity): void
    {
        /** @var Product $entity */
        $entity
            ->setName($formData['name'])
            ->setPrice($formData['price'])
            ->setBrand($this->entityManager->getRepository(Brand::class)->find($formData['brand']))
        ;
    }

    protected function tryToGet(object $entity, string $property, string $default = null)
    {
        $getter = 'get'.ucfirst($property);
        try {
            return $entity->$getter() ?? $default;
        } catch(\Error $e) {
            return $default;
        }
    }

    protected function getBrandOptions(): array
    {
        $results = $this->entityManager->getRepository(Brand::class)->createQueryBuilder('b')
            ->select('b.id, b.name')
            ->orderBy('b.name')
            ->getQuery()
            ->execute([],AbstractQuery::HYDRATE_ARRAY);
        $output = [];
        foreach($results as $result) {
            $output[$result['id']] = $result['name'];
        }
        return $output;
    }

}