<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Service\ProductService;
use App\Service\LogService;

class ImportXmlCommand extends Command
{
    private $productService;
    private $logService;
    private $entityManager;
    private $items = 0;
    private $newItems = 0;
    private $logData = [];

    public function __construct(ProductService $productService, LogService $logService)
    {
        $this->productService = $productService;
        $this->logService = $logService;
        parent::__construct();
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->productService = $container->get('App\Service\ProductService');
        $this->logService = $container->get('App\Service\LogService');
    }

    protected function configure()
    {
        $this
            ->setName('app:import-xml')
            ->setDescription('Imports product data from an XML file')
            ->addArgument('file', null, InputArgument::OPTIONAL, 'files/feed.xml');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln(["Start importing..."]);

        $file = $input->getArgument('file');

        if (!file_exists($file)) {
            $output->writeln("<error>File '$file' does not exist!</error>");
            return Command::INVALID;
        }

        $startTime = microtime(true);
        $reader = new \XMLReader();
        $reader->open($file);

        // Skip the root element (<catalog>)
        $reader->read();

        // To advance the XMLReader to the first item
        while ($reader->read() && $reader->name !== 'item');

        while ($reader->name === 'item') {
            $node = new \SimpleXMLElement($reader->readOuterXml());
            $this->productService->processProductNode($node, $this->logData, $this->newItems);
            $this->items++;
            $reader->next('item');
        }
        $reader->close();

        $endTime = microtime(true);
        $execTime = $endTime - $startTime;

        $this->logService->writeExcel($this->logData);
        $output->writeln([
            "XML Data imported in " . number_format($execTime, 2) . " seconds.",
            "Processed items: " . $this->items,
            "New items: " . $this->newItems,
        ]);

        return Command::SUCCESS;
    }

}
