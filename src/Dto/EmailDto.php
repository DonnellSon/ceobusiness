<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class EmailDto
{
    #[Assert\NotBlank()]
    #[Assert\Email()]
    public string $msg_email;

    #[Assert\NotBlank()]
    public string $object;

    #[Assert\NotBlank()]
    public string $message;
}