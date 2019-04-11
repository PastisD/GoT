<?php

namespace App\Form;

use App\Entity\UserCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCharacterType extends AbstractType
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
            ->add('throne', null, [
                'label' => 'Accède au Trône de fer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacter::class,
        ]);
    }
}
