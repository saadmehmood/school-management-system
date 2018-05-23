<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classes;
use AppBundle\Entity\Teachers;
use AppBundle\Repository\ClassesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ClassesController extends Controller
{
    /**
     * @Route("classes", name="classes_listing")
     */
    public function indexAction()
    {
        $classes = $this->getDoctrine()
            ->getRepository(Classes::class)
            ->getClassesWithTeacher();
        return $this->render('classes/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @Route("class/create", name="classes_create")
     */
    public function createAction(Request $request)
    {
        $classes = new Classes();

        $teachers = $this->getDoctrine()
            ->getRepository(Teachers::class)
            ->findAll();
        foreach ($teachers as $teacher) {
            $arr[$teacher->getName()] = $teacher->getId();
        }

        $form = $this->createFormBuilder($classes)
            ->add('name', TextType::class)
            ->add('section', TextType::class)
            ->add('teacherId', ChoiceType::class, array(
                'choices' => $arr,
                'label' => 'Teacher'
            ))
            ->add('save', SubmitType::class, array('label' => 'Add Class'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classes = $form->getData();

            $classes->setCreatedAt(new \DateTime('now'));
            $classes->setUpdatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classes);
            $entityManager->flush();

            return $this->redirectToRoute('classes_listing');
        }

        return $this->render('classes/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Add New Class Record'
        ]);
    }

    /**
     * @Route("class/edit/{id}", name="classes_update")
     */
    public function updateAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $class = $entityManager->getRepository(Classes::class)
            ->find($id);


        $form = $this->createFormBuilder($class)
            ->add('name', TextType::class)
            ->add('section', TextType::class)
            ->add('address', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Update Class Record'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $class = $form->getData();

            $class->setUpdatedAt(new \DateTime('now'));
            $entityManager->flush();

            return $this->redirectToRoute('classes_listing');
        }

        return $this->render('classes/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Update Class Record'
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("class/delete/{id}", name="classes_delete")
     */
    public function removeAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $classes = $entityManager->getRepository(Classes::class)
            ->find($id);
        if ($classes) {
            $entityManager->remove($classes);
            $entityManager->flush();
        }
        return $this->redirectToRoute('classes_listing');
    }
}
