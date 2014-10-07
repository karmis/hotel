<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 05.09.14
 * Time: 10:23
 */

namespace Brainstrap\Bundles\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ObjectRepository extends EntityRepository
{

    public function filterAllowed($startDate, $endDate)
    {
        $query = $this->createQueryBuilder("o")
            ->innerJoin("o.booked", "booked")
            ->where('booked.startDate NOT BETWEEN :sd AND :ed')
            ->andWhere('booked.endDate NOT BETWEEN :sd AND :ed')
            ->andWhere('booked.approved = :is')
            ->setParameter('sd', $startDate)
            ->setParameter('ed', $endDate)
            ->setParameter('is', true);

        return $query->getQuery()->getResult();
    }
}