<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationRequest
 * @package App\Request
 */
class RegistrationRequest extends AbstractRequest
{
    private const PASSWORD_MIN_LENGTH = 6;

    public function rules(): Assert\Collection
    {
        return new Assert\Collection([
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email()
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\Length([
                    'min' => self::PASSWORD_MIN_LENGTH
                ])
            ]
        ]);
    }
}