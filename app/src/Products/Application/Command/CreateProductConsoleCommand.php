<?php

declare(strict_types=1);

namespace App\Products\Application\Command;

use App\Products\Application\Command\CreateProduct\CreateProductCommand;
use App\Products\Application\Command\CreateProduct\CreateProductCommandHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-product-cli',
    description: 'Creates a new product via CLI.',
    aliases: ['app:add-product-cli']
)]
class CreateProductConsoleCommand extends Command
{
    private CreateProductCommandHandler $commandHandler;

    public function __construct(CreateProductCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the product.')
            ->addArgument('price', InputArgument::REQUIRED, 'The price of the product.')
            ->addArgument('sku', InputArgument::OPTIONAL, 'The SKU of the product.', 'DEFAULT_SKU');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        $price = (float) $input->getArgument('price');
        $sku = $input->getArgument('sku');

        $createProductCommand = new CreateProductCommand($name, $price, $sku);

        $this->commandHandler->__invoke($createProductCommand);

        $io->success('Product successfully created via CLI!');
        $io->table(
            ['Name', 'Price', 'SKU'],
            [[$name, $price, $sku]]
        );

        return Command::SUCCESS;
    }
}
