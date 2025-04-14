<?php

namespace App\Form;

use App\Entity\Dinosaurs;
use App\Entity\Period;
use App\Entity\Scientist;
use App\Entity\Species;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DinosaursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('height')
            ->add('weight')
            ->add('isLookingCool')
            ->add('lastSeen', null, [
                'widget' => 'single_text',
            ])
            ->add('period', EntityType::class, [
                'class' => Period::class,
                'choice_label' => 'name',
            ])
            ->add('species', EntityType::class, [
                'class' => Species::class,
                'choice_label' => 'name',
            ])
            ->add('scientists', EntityType::class, [
                'class' => Scientist::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dinosaurs::class,
        ]);
    }
}
