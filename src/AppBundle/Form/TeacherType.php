<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 6/12/18
 * Time: 11:20 AM
 */

namespace AppBundle\Form;


use AppBundle\Entity\Classes;
use AppBundle\Entity\Teacher;
use AppBundle\Service\TeacherService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('fatherName', TextType::class)
            ->add('phoneNumber', TelType::class, ['required' => false])
            ->add('address', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Teacher'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Teacher::class,
        ));
    }
}