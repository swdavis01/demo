<?php
namespace Swd\CoreBundle\Command;

//use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EntityCommand extends CoreCommand
{
    /**
     * @var $service \Swd\CoreBundle\Services\EntityService;
     */
    private $service;
    protected function configure()
    {
        $this
            ->setName('entity:create')
            ->setDescription('Creates base entities from the database schema')
            ->setHelp("Creates base entities from the database schema");
            //->addArgument( "path", InputArgument::REQUIRED, "The path to the iTunes XML file" );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$path = $input->getArgument( "path" );

        $this->service = $this->getContainer()->get( "swd_core_entity_service" );
        $this->service->setLogger( $this->logger );

        $this->logger->info( "Entity create" );

        $this->service->createBaseEntities();
    }
}