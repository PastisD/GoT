<?php

namespace App\Form;

use App\Entity\PollCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PollCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dead', null, [
                'label' => 'Mort'
            ])
            ->add('whiteWalker', null, [
                'label' => 'Marcheur blanc'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PollCharacter::class,
        ]);
    }
}
