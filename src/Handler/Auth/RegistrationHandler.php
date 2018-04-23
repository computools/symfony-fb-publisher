<?php

namespace App\Handler\Auth;

use App\Exception\User\UserAlreadyRegisteredException;
use App\Repository\UserRepository;
use App\Request\RegistrationRequest;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationHandler
 * @package App\Handler\Auth
 */
class RegistrationHandler
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var JWTManager
     */
    private $jwtManager;

    public function __construct(ContainerInterface $container, UserPasswordEncoderInterface $encoder)
    {
        $this->userRepository = $container->get('doctrine')->getRepository(User::class);
        $this->encoder = $encoder;
        $this->jwtManager = $container->get('lexik_jwt_authentication.jwt_manager');
    }

    public function __invoke(RegistrationRequest $request): string
    {
        if ($user = $this->userRepository->findOneBy([
            'email' => $request->get('email')
        ])) {
            throw new UserAlreadyRegisteredException();
        }
        $user = new User();
        $user->setEmail($request->get('email'));
        $user->setPassword($this->encoder->encodePassword(
            $user,
            $request->get('password')
        ));
        $this->userRepository->save($user);

        return $this->jwtManager->create($user);
    }
}