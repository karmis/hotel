<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 11.09.14
 * Time: 0:50
 */

namespace Brainstrap\Bundles\FrontBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteObjectCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bs:object:delete')
            ->setDescription('Deleted old objects')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $entities = $em->getRepository('BrainstrapBundlesFrontBundle:Object\Object')->createQueryBuilder('o')
            ->where('o.deleted = :is')
            ->setParameter('is', 1)
            ->getQuery()->getResult();

        foreach($entities as $entity)
        {
            $em->remove($entity);
        }

        $em->flush();
        $output->writeln("Was deleted " . count($entities) . " objects");
    }
}