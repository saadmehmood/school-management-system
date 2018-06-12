<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Classes;
use AppBundle\Entity\Teacher;
use AppBundle\Form\ClassesType;
use AppBundle\Service\ClassService;
use AppBundle\Service\TeacherService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ClassesController
 * @package AppBundle\Controller
 */
class ClassesController extends Controller
{
    /**
     * @param ClassService $classService
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("class", name="classes_listing")
     */
    public function indexAction(ClassService $classService)
    {
        $classes = $classService->getClassTeacher();
        return $this->render('classes/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * @param Request $request
     * @param TeacherService $teacherService
     * @param ClassService $classService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("class/create", name="classes_create")
     */
    public function createAction(Request $request, TeacherService $teacherService, ClassService $classService)
    {
        $classes = new Classes();

        $arr = $teacherService->teacherName();
        $form = $this->createForm(ClassesType::class, $classes, ['mapped'=>$arr]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classService->createClass($form);

            return $this->redirectToRoute('classes_listing');
        }

        return $this->render('classes/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Add New Class Record'
        ]);
    }

    /**
     * @param Request $request
     * @param ClassService $classService
     * @param TeacherService $teacherService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("class/edit/{id}", name="classes_update")
     */
    public function updateAction(Request $request, ClassService $classService, TeacherService $teacherService, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $class = $classService->getClass($id);


        $arr = $teacherService->teacherName();
        $form = $this->createForm(ClassesType::class, $class, ['mapped'=>$arr]);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $classService->updateClass($form);

            return $this->redirectToRoute('classes_listing');
        }

        return $this->render('classes/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Update Class Record'
        ]);
    }

    /**
     * @param ClassService $classService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("class/delete/{id}", name="classes_delete")
     */
    public function removeAction(ClassService $classService, $id)
    {
        $classService->removeClass($id);
        return $this->redirectToRoute('classes_listing');
    }
}
