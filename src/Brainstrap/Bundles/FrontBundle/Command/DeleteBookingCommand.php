<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 11.09.14
 * Time: 1:06
 */

namespace Brainstrap\Bundles\FrontBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteBookingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bs:booking:delete')
            ->setDescription('Deleted old booked')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\ObjectBooking')->createQueryBuilder('ob')
            ->where('ob.endDate < :now')
            ->setParameter('now', new \DateTime('now'))
            ->getQuery()->getResult();

        foreach($entities as $entity)
        {
            $entity->setDeleted(1);
              $em->persist($entity);
//            $em->remove($entity);
        }

        $em->flush();
        $output->writeln("Was deleted " . count($entities) . " objects");
    }
}