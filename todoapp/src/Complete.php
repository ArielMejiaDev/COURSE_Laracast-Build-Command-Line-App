<?php namespace Src;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Complete extends Command
{
    public function configure()
    {
        $this->setName('complete')->setDescription('completes a task')->addArgument('id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $this->database->query('delete from tasks where id = :id', compact('id'));
        $output->writeln('<info>Task Completed</info>');
        $this->showTasks($output);
    }
    
}