<?php

namespace App\Model\Trait;

trait IsNewTrait {
    public function isNew(): bool
    {
        try {
            return (bool)$this->id;
        } catch(\Error $error) {
            return true;
        }
    }
}
