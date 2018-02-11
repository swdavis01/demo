<?php
namespace Swd\MusicBundle\Command;

use Swd\CoreBundle\Command\CoreCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends CoreCommand
{
    protected function configure()
    {
        $this
            ->setName('music:import')
            ->setDescription('Import list of music from iTunes XML file')
            ->setHelp("Import list of music from iTunes XML file")
            ->addArgument( "path", InputArgument::REQUIRED, "The path to the iTunes XML file" );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument( "path" );

        $this->logger->info( "The path to the iTunes XML file is " . $path );
    }
}