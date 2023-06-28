<?php

namespace App\Form;

use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'choice',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chantier::class,
        ]);
    }
}
