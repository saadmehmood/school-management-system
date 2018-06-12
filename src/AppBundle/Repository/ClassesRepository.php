<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ClassesRepository
 * @package AppBundle\Repository
 */
class ClassesRepository extends EntityRepository
{
    public function getClassesWithTeacher()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('classes')
            ->from('AppBundle:Classes', 'classes')
            ->join('classes.teacher', 'teacher')
        ->addSelect('teacher');
        return $qb->getQuery()->getResult();
    }
}
