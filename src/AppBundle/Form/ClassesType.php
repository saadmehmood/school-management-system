<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 6/12/18
 * Time: 11:20 AM
 */

namespace AppBundle\Form;


use AppBundle\Entity\Classes;
use AppBundle\Service\TeacherService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('section', TextType::class)
            ->add('teacherId', ChoiceType::class, array(
                'choices' => $options['mapped'],
                'label' => 'Teacher'
            ))
            ->add('save', SubmitType::class, array('label' => 'Add Class'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Classes::class,
        ));
    }
}