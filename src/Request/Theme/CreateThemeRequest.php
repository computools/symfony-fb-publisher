<?php

namespace App\Request\Theme;

use App\Request\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateThemeRequest
 * @package App\Request\Theme
 */
class CreateThemeRequest extends AbstractRequest
{
    public function rules(): Assert\Collection
    {
        return new Assert\Collection([
            'title' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}