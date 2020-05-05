<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;

class AnimalType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('type', TextType::class)
                     ->add('color', TextType::class)
                     ->add('breed', TextType::class)
                     ->add('age', TextType::class)
                     ->add('submit', SubmitType::class,[
                        'label' => 'Create an animal',
                         'attr' => ['class' => 'btn']
                     ]);
    }
}
