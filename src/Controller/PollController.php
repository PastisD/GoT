<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PollCharacter;
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
        /** @var User $user */
        $user = $this->getUser();
        $poll = $user->getPoll();
        $pollCharacters = $poll->getPollCharacters();

        /** @var \App\Entity\Character[] $characters */
        $characters = $characterRepository->findAll();
        foreach ($characters as $character) {
            $alreadyFound = false;
            foreach ($pollCharacters as $pollCharacter) {
                if ($character->getId() === $pollCharacter->getCharac()->getId()) {
                    $alreadyFound = true;
                }
            }
            if(!$alreadyFound) {
                $pollCharacter = new PollCharacter();
                $pollCharacter->setCharac($character);
                $pollCharacter->setPoll($poll);
                $poll->addPollCharacter($pollCharacter);
            }
        }
        $pollForm = $this->createForm(PollType::class, $poll);

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
