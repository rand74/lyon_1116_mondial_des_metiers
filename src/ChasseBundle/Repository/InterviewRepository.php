<?php

namespace ChasseBundle\Repository;

use Doctrine\ORM\EntityRepository;
use ChasseBundle\Entity\Job;

/**
 * InterviewRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InterviewRepository extends EntityRepository
{
    public function getCountUsers() { //fonction qui compte le nombre d'entrée distinctes dans la table pour user (combien de user ont au moins répondus à un job)
         $qb = $this->createQueryBuilder('i')
            ->select('count(DISTINCT i.user)')
            ->getQuery();

             return $qb->getSingleScalarResult();
    }

    public function getCountJobs() { //fonction qui compte le nombre d'entrée distinctes pour 'name' dans la table (combien de jobs ont été répondus)
        $qb = $this->createQueryBuilder('i')
            ->select('count(DISTINCT i.job)')
            ->getQuery();

        return $qb->getSingleScalarResult();
    }

    public function get20jobs() { // fonction qui retourne les 20 métiers les plus répondus (donc c'est un array)
        $qb = $this->createQueryBuilder('i')
            ->select('i', 'j.name as name', 'count(i.id) as total')
            //->innerJoin( 'i', 'Job', 'j', 'j.id = i.job')
            ->innerJoin( 'i.job', 'j')
            ->groupBy('i.job')
            ->orderBy('total', 'DESC')
            ->setMaxResults(20)
            ->getQuery();

        return $qb->getResult();

    }

    public function get20domains() { // fonction qui retourne les 20 domaines les plus répondus (donc c'est un array)
        $qb = $this->createQueryBuilder('i')
            ->select('i', 'j.domain as domain', 'count(i.id) as total')
            ->innerJoin( 'i.job', 'j')
            ->groupBy('j.domain')
            ->orderBy('total', 'DESC')
            ->setMaxResults(20)
            ->getQuery();

        return $qb->getResult();

    }

}

/*

 */