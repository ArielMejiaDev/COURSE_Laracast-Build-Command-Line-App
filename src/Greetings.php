<?php  namespace Src;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Greetings extends Command
{
    public function configure()
    {
        $this->setName('greetings')->setDescription('Offer a greeting to the given person')
             ->addArgument('name', InputArgument::REQUIRED, 'Add your name')
             ->addOption('greeting', 'g', InputOption::VALUE_OPTIONAL, 'It Overrides the default greetings');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $message = sprintf("<info>Hello World %s</info>", $input->getArgument('name'));
        if ($input->getOption('greeting')) $message = sprintf("<info> %s %s </info>", $input->getOption('greeting'), $input->getArgument('name'));
        $output->writeln($message);
    }
}