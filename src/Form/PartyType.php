<?php

namespace App\Form;

use App\Entity\Party;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('hour_start')
            ->add('hour_end')
            ->add('child_age')
            ->add('children_number')
            ->add('place_type')
            ->add('moderate')
            ->add('archived')
            ->add('name')
            ->add('organised_by')
            ->add('prestations')
            ->add('pros')
            ->add('department')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Party::class,
        ]);
    }
}
