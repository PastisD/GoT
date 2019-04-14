<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\User;
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
        $users = $this->getDoctrine()->getRepository(User::class)->findBy([], [
            'lastName' => 'asc',
            'firstName' => 'asc',
        ]);
        /** @var Character[] $characters */
        $characters = $this->getDoctrine()->getRepository(Character::class)->findBy([], [
            'name' => 'asc',
        ]);

        return $this->render('default/index.html.twig', [
            'users' => $users,
            'characters' => $characters,
            'controller_name' => 'DefaultController',
        ]);
    }
}
