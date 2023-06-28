<?php

namespace App\Form;

use App\Entity\Pointage;
use App\Entity\User;
use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'matricule',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('chantier', EntityType::class, [
                'class' => Chantier::class,
                'choice_label' => 'nom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('date', DateType::class, [
                'widget' => 'choice',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('duree', TimeType::class, [
                'widget' => 'choice',
                'html5' => false,
                'input' => 'string',
                'input_format' => 'H:i',
                'attr' => ['class' => 'timepicker'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
        ]);
    }
}
