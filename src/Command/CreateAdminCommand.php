<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Service\UserManager;
use App\Utils\AdminDataGetter;

use App\Entity\User;

class CreateAdminCommand extends Command
{
    private $userManager;
    private $adminDataGetter;
    private $encoder;

    public function __construct(UserManager $userManager, AdminDataGetter $adminDataGetter,  UserPasswordEncoderInterface $encoder)
    {
        $this->userManager = $userManager;
        $this->adminDataGetter = $adminDataGetter;
        $this->encoder = $encoder;

        parent::__construct();
    }

    protected function configure()
    {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('app:create:admin')

                // the short description shown while running "php bin/console list"
                ->setDescription('Create default admin user.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('This command creates default admin user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('Creating User');
            $this->createUser();            
        } catch (WrongParamsException $exception) {
            $output->writeln($exception->getMessage());
        }
    }

    private function createUser()
    {
        $user = new User();
        $username = $this->adminDataGetter->getUsername();
        $password = $this->adminDataGetter->getPassword();

        $user->setUsername($username)
             ->setRole('ROLE_ADMIN');
        $hash = $this->encoder->encodePassword($user, $password);
        $user->setPassword($hash)
            ->setUpdatedAt(new \DateTime);
        $this->userManager->createUser($user);
    }
    
}
