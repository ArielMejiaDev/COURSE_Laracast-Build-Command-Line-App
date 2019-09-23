<?php namespace Src;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UsersAllCommand extends Command
{
    public function configure()
    {
        $this->setName('users-all')->setDescription('It renders a table with users just by example');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Email'])->setRows([
            ['Taylor Otwell', 'taylor@laravel.com'],
            ['Jeffrey Way', 'jefrey@laracast.com'],
            ['Adam Wathan', 'adam@tailwhindcss.com'],
            ['Freak Van Der Heerten', 'freak@spatie.com'],
            ['Matt Stauffer', 'matt@laravelupandrunning.com'],
            ['Caleb Porzio', 'caleb@livewire.com'],
            ['Paul Redmond', 'paul@laravelnews.com'],
            ['Jake Bennet', 'jake@laravelnews.com'],
            ['Michael Dyrinda', 'michael@laravelnews.com'],
            ['Nuno Maduro', 'nuno@insights.com'],
            ['Marcel Pociot', 'macel@phppackagesdevelopment.com'],
            ['Christoph Rumpel', 'nuno@laravelcoreadventures.com'],
            ['Polivas Korob', 'polivas@laraveldaily.com'],
        ])->render();
    }
}