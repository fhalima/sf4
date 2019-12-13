<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'user_admin', function ($num) {
            $admin = new User();
            $admin
                ->setEmail(sprintf('admin%d@kritik.fr', $num))
                ->setPseudo(sprintf('admin%d', $num))
                ->setRoles(['ROLE_ADMIN'])
                ->setIsConfirmed(true)
                ->setPassword($this->encoder->encodePassword($admin, 'admin' . $num))
            ;

            return $admin;
        });

        $this->createMany(40, 'user_user', function ($num) {
            $user = new User();
            $user
                ->setEmail(sprintf('user%d@mail.org', $num))
                ->setPseudo(sprintf('user%d', $num))
                ->setIsConfirmed(true)
                ->setPassword($this->encoder->encodePassword($user, 'user' . $num))
            ;

            return $user;
        });

        $manager->flush();
    }
}