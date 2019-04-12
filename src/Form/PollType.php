<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Poll;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PollType
 *
 * @package App\Form
 */
class PollType extends AbstractType
{
    /**
     * @var \App\Repository\CharacterRepository
     */
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pollCharacters', CollectionType::class, ['entry_type' => PollCharacterType::class])
            ->add('throne', EntityType::class, [
                'label' => 'Qui sera sur le thrône ?',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'class' => Character::class,

                'choice_label' => function (Character $character) {
                    return $character->getName();
                }
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Poll::class,
            ]
        );
    }
}
