<?php

namespace App\Tests\Users\Application\Command;

use App\Users\Application\Command\CreateUser\CreateUserCommandHandler;
use App\Users\Application\Command\CreateUserConsoleCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Command\Command;

class CreateUserConsoleCommandTest extends TestCase
{
    public function testExecute(): void // Agregado el tipo de retorno void
    {
        // Crear un mock del handler
        $commandHandler = $this->createMock(CreateUserCommandHandler::class);

        // Configurar el mock para que devuelva un valor cuando se llame al handler
        $commandHandler->method('__invoke')->willReturn('12345');

        // Crear una instancia del comando con el mock
        $command = new CreateUserConsoleCommand($commandHandler);

        // Configurar la aplicación y el tester de comandos
        $application = new Application();
        $application->add($command);

        // Crear el tester de comandos y ejecutar el comando
        $commandTester = new CommandTester($application->find('app:create-user-cli'));
        $commandTester->execute([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Verificar la salida del comando
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('User successfully created via CLI!', $output);
        $this->assertStringContainsString('test@example.com', $output);
        $this->assertStringContainsString('password123', $output);

        // Verificar que el comando retorne el código de éxito
        $this->assertEquals(Command::SUCCESS, $commandTester->getStatusCode());
    }
}

