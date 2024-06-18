<?php
declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use App\Products\ImportApi;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'product:sync')]
class ImportApiCommand extends Command
{
    public $projectDir;

    public function __construct(
        private ImportApi $importApi,
        string $name = null)
    {
        parent ::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $content = $this->importApi->fetchApiInformation();
        $this->importApi->createJson($content);
//        $this->importApi->fetchJson();
        $output->writeln('Api content is put in a JSON file');
        return Command::SUCCESS;
    }
}