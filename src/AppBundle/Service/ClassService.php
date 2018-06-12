<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 6/11/18
 * Time: 2:25 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\Classes;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ClassService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $entityManager;

    /**
     * ClassService constructor.
     * @param EntityManagerInterface $entityManagerInterface
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(EntityManagerInterface $entityManagerInterface, ManagerRegistry $managerRegistry)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->entityManager = $managerRegistry->getManager();
    }

    /**
     * @return mixed
     */
    public function getClassTeacher()
    {
        $classes = $this->entityManagerInterface->getRepository(Classes::class)
            ->getClassesWithTeacher();

        return $classes;
    }

    /**
     * @param $form
     */
    public function createClass($form)
    {
        $classes = $form->getData();

        $classes->setCreatedAt(new \DateTime('now'));
        $classes->setUpdatedAt(new \DateTime('now'));
        $this->entityManager->persist($classes);
        $this->entityManager->flush();
    }

    /**
     * @param $form
     */
    public function updateClass($form)
    {
        $class = $form->getData();

        $class->setUpdatedAt(new \DateTime('now'));
        $this->entityManager->flush();
    }

    /**
     * @param $id
     */
    public function removeClass($id)
    {
        $class = $this->getClass($id);
        if ($class) {
            $this->entityManager->remove($class);
            $this->entityManager->flush();
        }
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getClass($id)
    {
        $class = $this->entityManagerInterface->getRepository(Classes::class)
            ->find($id);

        return $class;
    }
}