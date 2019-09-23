<?php  namespace Src;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive;

class NewCommand extends Command
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('new')->setDescription('Creates a new app')
             ->addArgument('name', InputArgument::REQUIRED);
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = $this->getDirectory($input->getArgument('name'));
        $zipFile = $this->makeFileName();

        $this->assertApplicationDoesNotExists($directory, $output);

        $output->writeln('<comment>Crafting the application...</comment>');

        $this->download($zipFile)->extract($zipFile, $directory)->cleanUp($zipFile);

        $output->writeln('<info>Application ready build something amazing!</info>');

    }

    private function getDirectory($appName)
    {
        return getcwd() . '/'. $appName;
    }

    private function assertApplicationDoesNotExists($directory, OutputInterface $output)
    {
        if (is_dir($directory)) {
            $output->writeln('<error>Application already exists</error>');
            die();
        }
    }

    private function makeFileName()
    {
        return getcwd() . '/laravel_'. md5(time() . uniqid()) . '.zip';
    }

    private function download($zipFile)
    {
        $url = 'http://cabinet.laravel.com/latest.zip';
        $response = $this->client->get($url)->getBody();
        file_put_contents($zipFile, $response);
        return $this;
    }

    private function extract($file, $directory)
    {
        $zip = new ZipArchive();
        $zip->open($file);
        $zip->extractTo($directory);
        $zip->close();
        return $this;
    }

    private function cleanUp($zipFile)
    {
        @chmod($zipFile, 0777);
        @unlink($zipFile);
    }

}