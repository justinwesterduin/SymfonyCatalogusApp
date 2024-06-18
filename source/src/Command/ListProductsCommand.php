<?php
declare(strict_types=1);

namespace App\Command;

use App\Products\ListProducts;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'product:list')]
class ListProductsCommand extends Command
{
    public function __construct(
        private ListProducts $listProducts,
        string $name = null
    )
    {
        parent ::__construct($name);
    }

    /**
     * @throws \JsonException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productInfo = $this->listProducts->fetchJson();
        $prodRes = $this->listProducts->filterProducts($productInfo);
        $prodList = json_encode($prodRes, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        $output->writeln('<info>' . $prodList . '</info>');
//        var_dump($product[4]);
        return COMMAND::SUCCESS;
    }
}