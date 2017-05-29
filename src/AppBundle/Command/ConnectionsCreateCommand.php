<?php

namespace AppBundle\Command;

use AppBundle\Entity\Connection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Util\PolskiBus\PolskiBus;
use AppBundle\Util\PolskiBus\Data\ConnectionData;

class ConnectionsCreateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:connections:create')
            ->setDescription('')
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
        $repository = $em->getRepository('AppBundle:Station');

        $polskiBus = new PolskiBus();
        $connectionsDataArray = $polskiBus->getConnections();
        $output->writeln('Response from polskibus obtained');

        foreach ($connectionsDataArray as $connectionData) {
            $connection = new Connection();
            $departure = $repository->findOneBy(['code' => $connectionData->getDeparture()]);
            $connection->setDeparture($departure);
            $destination = $repository->findOneBy(['code' => $connectionData->getDestination()]);
            $connection->setDestination($destination);
            $connection->setFirstDate($connectionData->getFirstDate());
            $connection->setLastDate($connectionData->getLastDate());
            $em->persist($connection);
        }
        $em->flush();
        $output->writeln('Connections data create');
    }
}
