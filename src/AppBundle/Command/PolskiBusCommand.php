<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Util\PolskiBus\CourseUpdater;
use AppBundle\Entity\Course;
use AppBundle\Entity\Station;

class PolskiBusCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:pbus')
            ->setDescription('')
            ->setHelp('');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $departure = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 29]);
        $destination = $em->getRepository('AppBundle:Station')->findOneBy(['code' => 2]);

        $date = new \DateTime();
        $date->modify('+20 days');

        $courseUpdater = new CourseUpdater();
        $courseDataArray = $courseUpdater->update($departure, $destination, $date);
        foreach ($courseDataArray as $courseData) {
            $course = new Course();
            $course->setDeparture($departure);
            $course->setDestination($destination);
            $course->setPrice($courseData->getPrice());
            $course->setDepartureDate($courseData->getDepartureDate());
            $course->setArrivalDate($courseData->getArrivalDate());
            $em->persist($course);
            $em->flush();
        }
    }
}
