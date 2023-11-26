<?php

namespace App\Form;

use App\Model\Database\Brand;
use App\Model\Form\BaseEntityForm;
use Nette\Application\UI\Form;

class BrandForm extends BaseEntityForm {
    protected function configureForm(object $entity): void
    {
        /** @var Brand $entity */
        $this
            ->addText('name', 'Název')
            ->addRule(\Nette\Forms\Form::MaxLength, 'Maximální délka je 255', 255)
            ->setRequired()
            ->setDefaultValue($this->tryToGet($entity, 'name', ''))
        ;
        $this
            ->addSubmit('send', 'Uložit')
            ->setHtmlAttribute('class', 'btn')
        ;
    }

    protected function bindData(array $formData, object $entity): void
    {
        /** @var Brand $entity */
        $entity->setName($formData['name']);
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

}