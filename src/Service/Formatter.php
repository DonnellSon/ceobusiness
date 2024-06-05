<?php

namespace App\Service;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class Formatter {

	public function formatErrors(ConstraintViolationListInterface $errors): array
    {
        $errorArray = [];
        foreach ($errors as $err){
            $errorArray[$err->getPropertyPath()] = $err->getMessage();
        }
        return $errorArray;
    }

}
