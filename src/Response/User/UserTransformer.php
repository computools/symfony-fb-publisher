<?php

namespace App\Response\User;

use App\Entity\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package App\Response\User
 */
class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
    }
}