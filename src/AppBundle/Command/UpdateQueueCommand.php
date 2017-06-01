<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\UpdateQueue;

class UpdateQueueCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:queue:update')
            ->setDescription('Updates Queue')
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
        $connections = $em->getRepository('AppBundle:Connection')->findTracked();

        $validator = $this->getContainer()->get('validator');

        foreach ($connections as $connection) {
            $dates = new \DatePeriod(
                new \DateTime('now'),
                new \DateInterval('P1D'),
                $connection->getLastDate()
            );

            foreach ($dates as $date) {
                $updateQueue = new UpdateQueue();
                $updateQueue->setConnection($connection);
                $updateQueue->setDate($date);
                $errors = $validator->validate($updateQueue);
                if (count($errors) == 0) {
                    $em->persist($updateQueue);
                }
            }
        }

        $em->flush();

        $output->writeln('Queue updated');
    }
}
