<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Util\PolskiBus\PolskiBus;
use AppBundle\Entity\Station;
use Symfony\Component\Security\Acl\Exception\Exception;

class PolskiBusCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:station:create')
            ->setDescription('Create station table in database')
            ->setHelp('This command sends request to polskibus.com collect the data of stations and flush it to database');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Start',
        ]);

        $em = $this->getContainer()->get('doctrine')->getManager();

        $polskiBus = new PolskiBus();
        $stationDataArray = $polskiBus->getStations();
        $output->writeln('Response from polskibus obtained');

        foreach ($stationDataArray as $stationData) {
            $station = new Station();
            $station->setName($stationData->getName());
            $station->setCode($stationData->getCode());
            $em->persist($station);
        }
        $em->flush();
        $output->writeln('Stations data create');
    }
}
