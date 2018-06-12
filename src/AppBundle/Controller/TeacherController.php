<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use AppBundle\Form\TeacherType;
use AppBundle\Service\TeacherService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    /**
     * @param TeacherService $teacherService
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("teacher", name="teacher_listing")
     */
    public function indexAction(TeacherService $teacherService)
    {
        $teachers = $teacherService->getTeachers();

        return $this->render('teacher/index.html.twig', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * @param Request $request
     * @param TeacherService $teacherService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("teacher/create", name="teacher_create")
     */
    public function createAction(Request $request, TeacherService $teacherService)
    {
        $teacher = new Teacher();


        $form = $this->createForm(TeacherType::class, $teacher);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teacherService->createTeacher($form);

            return $this->redirectToRoute('teacher_listing');
        }

        return $this->render('teacher/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Add New Teacher Record'
        ]);
    }

    /**
     * @param Request $request
     * @param TeacherService $teacherService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("teacher/edit/{id}", name="teacher_update")
     */
    public function updateAction(Request $request, TeacherService $teacherService, $id)
    {
        $teacher = $teacherService->getTeacher($id);


        $form = $this->createForm(TeacherType::class, $teacher);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teacherService->updateTeacher($form);

            return $this->redirectToRoute('teacher_listing');
        }

        return $this->render('teacher/new.html.twig', [
            'form' => $form->createView(), 'heading' => 'Update Teacher Record'
        ]);
    }

    /**
     * @param TeacherService $teacherService
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("teacher/delete/{id}", name="edit_teacher_delete")
     */
    public function removeAction(TeacherService $teacherService, $id)
    {
        $teacherService->removeTeacher($id);
        return $this->redirectToRoute('teacher_listing');
    }
}
