<?php

namespace AppBundle\Command;

use AppBundle\Entity\Connection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Util\PolskiBus\PolskiBus;
use AppBundle\Util\PolskiBus\Data\ConnectionData;

class ConnectionsUpdateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:connections:update')
            ->setDescription('Update connection data')
            ->setHelp('');
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
        $repository = $em->getRepository('AppBundle:Connection');

        $polskiBus = new PolskiBus();
        $connectionsDataArray = $polskiBus->getConnections();
        $output->writeln('Response from polskibus obtained');

        foreach ($connectionsDataArray as $connectionData) {
            $connection = $repository->findOneBy([
                'departure' => $connectionData->getDepartureCode(),
                'destination' => $connectionData->getDestinationCode()
            ]);
            $connection->setLastDate($connectionData->getLastDate());
        }
        $em->flush();
        $output->writeln('Connections data updated');
    }
}
