<?php

namespace App\Users\Application\Command;

use App\Users\Application\Command\CreateUser\CreateUserCommand;
use App\Users\Application\Command\CreateUser\CreateUserCommandHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-user-cli',
    description: 'Creates a new user via CLI.',
    aliases: ['app:add-user-cli']
)]
class CreateUserConsoleCommand extends Command
{
    private CreateUserCommandHandler $commandHandler;

    public function __construct(CreateUserCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        // Crear un nuevo comando de creación de usuario
        $createUserCommand = new CreateUserCommand($email, $password);

        // Ejecutar el comando para crear el usuario utilizando CreateUserCommandHandler
        $userId = ($this->commandHandler)($createUserCommand);

        $io->success('User successfully created via CLI!');
        $io->table(
            ['Email', 'Password'],
            [[$email, $password]]
        );

        return Command::SUCCESS;
    }
}
