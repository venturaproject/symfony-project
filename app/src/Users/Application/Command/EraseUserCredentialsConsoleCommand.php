<?php

declare(strict_types=1);

namespace App\Users\Application\Command;

use App\Users\Application\Query\FindUserByEmail\FindUserByEmailQuery;
use App\Users\Application\Command\EraseUserCredentials\EraseUserCredentialsCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use App\Users\Application\DTO\UserDTO;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;


#[AsCommand(
    name: 'app:erase-user-credentials',
    description: 'Erase user credentials via CLI.',
    aliases: ['app:remove-user-credentials']
)]
class EraseUserCredentialsConsoleCommand extends Command
{
    private MessageBusInterface $commandBus;
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $commandBus, MessageBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');

        // Buscar el usuario por su email utilizando el Query Bus
        try {
            $envelope = $this->queryBus->dispatch(new FindUserByEmailQuery($email));
            $handledStamp = $envelope->last(HandledStamp::class);

            if (!$handledStamp) {
                throw new \Exception('User not found');
            }

            /** @var UserDTO $userDTO */
            $userDTO = $handledStamp->getResult();
        } catch (\Exception $e) {
            $io->error('User not found.');
            return Command::FAILURE;
        }

        // Crear un nuevo comando de eliminación de credenciales de usuario
        $eraseUserCredentialsCommand = new EraseUserCredentialsCommand($userDTO->ulid);

        // Ejecutar el comando para eliminar las credenciales del usuario
        $this->commandBus->dispatch($eraseUserCredentialsCommand);

        $io->success('User credentials successfully erased via CLI!');
        $io->table(
            ['Email'],
            [[$email]]
        );

        return Command::SUCCESS;
    }
}



