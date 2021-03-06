<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teachers;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    /**
     * @Route("teacher", name="teacher_listing")
     */
    public function indexAction(Request $request)
    {
        $teacher = $this->getDoctrine()
            ->getRepository(Teachers::class)
            ->findAll();
        // replace this example code with whatever you need
        return $this->render('teacher/index.html.twig', [
            'teachers' => $teacher,
        ]);
    }

    /**
     * @Route("teacher/create", name="teacher_create")
     */
    public function createAction(Request $request)
    {
        $teacher = new Teachers();


        $form = $this->createFormBuilder($teacher)
            ->add('name', TextType::class)
            ->add('fatherName', TextType::class)
            ->add('phoneNumber', TelType::class, ['required' => false])
            ->add('address', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Customer'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teacher = $form->getData();

            $teacher->setCreatedAt(new \DateTime('now'));
            $teacher->setUpdatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($teacher);
            $entityManager->flush();

            return $this->redirectToRoute('teacher_listing');
        }

        return $this->render('teacher/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
