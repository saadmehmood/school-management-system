<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 6/12/18
 * Time: 12:02 PM
 */

namespace AppBundle\Service;


use AppBundle\Entity\Teacher;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class TeacherService
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
     * TeacherService constructor.
     * @param EntityManagerInterface $entityManagerInterface
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(EntityManagerInterface $entityManagerInterface, ManagerRegistry $managerRegistry)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->entityManager = $managerRegistry->getManager();
    }

    /**
     * @return array
     */
    public function getTeachers()
    {
        $teachers = $this->entityManagerInterface->getRepository(Teacher::class)
            ->findAll();

        return $teachers;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getTeacher($id)
    {
        $class = $this->entityManagerInterface->getRepository(Teacher::class)
            ->find($id);

        return $class;
    }

    /**
     * @return array
     */
    public function teacherName()
    {
        $teachers = $this->getTeachers();
        $arr = [];
        foreach ($teachers as $teacher) {
            $arr[$teacher->getName()] = $teacher->getId();
        }
        return $arr;
    }

    /**
     * @param $form
     */
    public function createTeacher($form)
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
    public function updateTeacher($form)
    {
        $class = $form->getData();

        $class->setUpdatedAt(new \DateTime('now'));
        $this->entityManager->flush();
    }

    /**
     * @param $id
     */
    public function removeTeacher($id)
    {
        $class = $this->getClass($id);
        if ($class) {
            $this->entityManager->remove($class);
            $this->entityManager->flush();
        }
    }

}