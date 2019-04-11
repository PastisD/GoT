<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserCharacter;
use App\Form\PollType;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PollController extends AbstractController
{
    /**
     * @Route("/poll", name="poll")
     * @param \App\Repository\CharacterRepository $characterRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function poll(Request $request, CharacterRepository $characterRepository)
    {
        $user = $this->getUser();
        $userCharacters = $user->getUserCharacters();

        /** @var \App\Entity\Character[] $characters */
        $characters = $characterRepository->findAll();
        foreach ($characters as $character) {
            $alreadyFound = false;
            foreach ($userCharacters as $userCharacter) {
                if ($character->getId() === $userCharacter->getCharac()->getId()) {
                    $alreadyFound = true;
                }
            }
            if(!$alreadyFound) {
                $userCharacter = new UserCharacter();
                $userCharacter->setCharac($character);
                $userCharacter->setUser($user);
                $user->addUserCharacter($userCharacter);
            }
        }
        $pollForm = $this->createForm(PollType::class, $user);

        $pollForm->handleRequest($request);

        if ($pollForm->isSubmitted() && $pollForm->isValid()) {
            $user = $pollForm->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('poll');
        }

        return $this->render('poll/poll.html.twig', [
            'form' => $pollForm->createView(),
        ]);
    }
}
