<?php
namespace Swd\CoreBundle\Command;

use Swd\CoreBundle\Util\ConsoleLogger;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

abstract class CoreCommand extends ContainerAwareCommand
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     *
     * @var \SWD\CoreBundle\Util\ConsoleLogger
     */
    protected $logger;

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        //$container = $this->getContainer();

        $this->input  = $input;
        $this->output = $output;

        //initialise the logger
        $this->initLogger( $output );
    }

    /**
     * set the logger
     */
    protected function initLogger( OutputInterface $output )
    {
        $this->logger = new ConsoleLogger( $output );
    }

    /**
     *
     * @return \SWD\CoreBundle\Util\ConsoleLogger
     */
    protected function getLogger()
    {
        return $this->logger;
    }

    /**
     *
     */
    protected function getDialog()
    {
        return $this->getHelperSet()->get('dialog');
    }

    /**
     *
     * @param string $question
     * @return boolean
     */
    protected function askConfirmation($question)
    {
        return $this->getDialog()->askConfirmation($this->output, $question.'  [Y/n]?', true);
    }
}