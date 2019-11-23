<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\Film;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MyAccountController extends Controller
{
    /**
     * @Route("/account")
     */
    public function indexAction($message = null) {
        $em = $this->getDoctrine();
        /** @var User $user */
        $user = $this->getUser();
        $favoriteFilms = $em->getRepository(Film::class)->listByUser($user);
        $films = [];
        /** @var Film $film */
        foreach ($favoriteFilms as $index => $film){
            $filmData = urldecode($favoriteFilms[$index]->getFilmData());
            $data = json_decode($filmData,true);
            $films[] = $data;
        }

        return $this->render('account.html.twig', [
            'message' => $message,
            'favorites' => $films
        ]);
    }

    /**
     * @Route("/film/addfavorite/{id}/{score}/{data}")
     */
    public function addFavoriteAction ($id, $score, $data){
        $em = $this->getDoctrine()->getManager();
        /**@var User $user */
        $user = $this->getUser();
        if (isset($user)){
            $film = $em->getRepository(Film::class)->getByApiIdandUser($user, $id);

        }
        if ($film == null) {
            $film = new Film();
            $film->setApiId($id);
            $film->setUserId($user->getId());
            $film->setScore($score * 100);
            $film->setFilmData($data);
            $em->persist($film);
            $em->flush();
            $message = "The Film has been added to your favorites";
        }
        else {
            $message = "This film has been already added to your favorites";
        }
        return $this->indexAction($message);
    }
}