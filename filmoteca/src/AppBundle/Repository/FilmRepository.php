<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param User $user
     * @return mixed
     */
    public function listByUser (User $user){
        $qb = $this->createQueryBuilder('film')
            ->andWhere('film.userId =:user')
            ->addOrderBy('film.score','DESC')
            ->setParameter('user', $user->getId())
        ;

        return $qb->getQuery()->execute();
    }

    /**
     * @param User $user
     * @param $api_id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByApiIdandUser (User $user,$api_id) {
       $qb = $this->createQueryBuilder('film')
            ->andWhere('film.userId =:user')
            ->andWhere('film.apiId =:api_id')
            ->setParameters([
                'user' => $user->getId(),
                'api_id' => $api_id
            ])
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}