<?php

namespace App\Command;

use App\Services\IpService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckIpCommand extends Command
{
    private $ipService;

    public function __construct(IpService $ipService) {
        parent::__construct();
        $this->ipService = $ipService;
    }

    protected function configure() {
        $this->setName('app:check-ip')
            ->addArgument('ip', InputArgument::REQUIRED, 'Ip address');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $ipinfo = $this->ipService->getInfo($input->getArgument('ip'), true);
        if ($ipinfo != null) {
            $output->writeln("Ip Address: {$ipinfo->ip}");
            $output->writeln("Country Code: {$ipinfo->country_code}");
            $output->writeln("Country: {$ipinfo->country}");
            $output->writeln("Region: {$ipinfo->region}");
            $output->writeln("City: {$ipinfo->city}");
            $output->writeln("Latitude: {$ipinfo->latitude}");
            $output->writeln("Longitude: {$ipinfo->longitude}");
            $output->writeln("Zip Code: {$ipinfo->zip_code}");
            $output->writeln("Time Zone: {$ipinfo->time_zone}");
        } else {
            $output->writeln("An error occurred");
        }
    }
}
