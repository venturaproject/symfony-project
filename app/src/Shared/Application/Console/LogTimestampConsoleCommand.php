<?php

declare(strict_types=1);

namespace App\Shared\Application\Console;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:log-timestamp',
    description: 'Logs the current date and time to a log file.'
)]

class LogTimestampConsoleCommand extends Command
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    protected function configure(): void
    {
       
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $timestamp = (new \DateTime())->format('Y-m-d H:i:s');
        $this->logger->info("Timestamp logged: " . $timestamp);

        $io->success('Timestamp logged successfully!');
        $io->writeln("Logged Timestamp: " . $timestamp);

        return Command::SUCCESS;
    }
}
