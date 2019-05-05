<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\PollCharacter;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        /** @var User[] $users */
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        /** @var Character[] $characters */
        $characters = $this->getDoctrine()->getRepository(Character::class)->findBy([], [
            'name' => 'asc',
        ]);

        $cmp = function (User $a, User $b)
        {
            if ($a->getPoll()->getPoints() == $b->getPoll()->getPoints()) {
                return 0;
            }
            return ($a->getPoll()->getPoints() > $b->getPoll()->getPoints()) ? -1 : 1;
        };
        usort($users, $cmp);

        return $this->render('default/index.html.twig', [
            'users' => $users,
            'characters' => $characters,
            'controller_name' => 'DefaultController',
        ]);
    }
}
