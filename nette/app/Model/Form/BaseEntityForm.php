<?php

namespace App\Model\Form;

use App\Model\Database\Brand;
use Nette\Application\UI\Form;

abstract class BaseEntityForm extends Form {
    protected ?object $entity;
    public array $onSuccessEntity = [];

    public function configure(object $entity, array $onSuccessCallback): void
    {
        $this->entity = $entity;
        $this->configureForm($this->entity);
        $this->onSuccess[] = [$this, 'formSucceeded'];
        $this->onSuccessEntity[] = $onSuccessCallback;
    }

    public function formSucceeded(Form $form, array $formData): void
    {
        $this->bindData($formData, $this->entity);
        foreach ($this->onSuccessEntity as $callable) {
            call_user_func_array($callable, [$form, $this->entity]);
        }
    }

    abstract protected function configureForm(object $entity): void;
    abstract protected function bindData(array $formData, object $entity): void;
}
