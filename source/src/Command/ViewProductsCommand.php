<?php
declare(strict_types=1);

namespace App\Command;

use JsonException;
use App\Products\ViewProducts;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'product:view')]
class ViewProductsCommand extends Command
{
    public function __construct(
        private ViewProducts $viewProducts,
        string $name = null)
    {
        parent ::__construct($name);
    }

    public function configure(): void
    {
        $this->setDescription('Fetch product by id')->addArgument('id');
    }

    /**
     * @throws JsonException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $product = $this->viewProducts->filterProdById((int)$input->getArgument('id'));
        $jsonData = json_encode($product, JSON_THROW_ON_ERROR);
        $output->writeln('<info>'. $jsonData .'</info>');
        return COMMAND::SUCCESS;
    }
}