<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('senha', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $senha = $input->getArgument('senha');

        if (empty($email) || empty($senha)) {
            throw new \InvalidArgumentException('Informe o e-mail e senha!');
        }

        $user = new User();
        $user
            ->setEmail($email)
            ->setPassword($this->userPasswordHasher->hashPassword($user, $senha))
            ->setRoles(['ROLE_USER']);

        $this->userRepository->save($user);

        return Command::SUCCESS;
    }
}