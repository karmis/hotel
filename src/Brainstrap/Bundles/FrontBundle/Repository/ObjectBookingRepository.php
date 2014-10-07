<?php
/**
 * Created by PhpStorm.
 * User: karmis
 * Date: 05.09.14
 * Time: 10:23
 */

namespace Brainstrap\Bundles\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ObjectBookingRepository extends EntityRepository
{

    public function filterAllowedById($id, $startDate, $endDate)
    {
        $query = $this->createQueryBuilder("ob")
            ->innerJoin('ob.object', 'object')
            ->where('ob.startDate BETWEEN :sd AND :ed')
            ->andWhere('ob.endDate BETWEEN :sd AND :ed')
            ->andWhere('object.id = :id')
            ->andWhere('ob.approved = :is')
            ->setParameter('sd', $startDate)
            ->setParameter('ed', $endDate)
            ->setParameter('is', true)
            ->setParameter('id', $id);

        return $query->getQuery()->getResult();
    }
}