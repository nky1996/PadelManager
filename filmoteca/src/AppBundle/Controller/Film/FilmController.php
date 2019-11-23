<?php

namespace AppBundle\Controller\Film;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends Controller {
    /**
     * @Route("/film/{page}")
     */
    public function indexAction($page = 1) {
        $api_key = $this->getParameter('api_key');
        $film_service = $this->get('film.service');
        //todo : cache with redis.
        $query = "discover/movie?language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=" . $page;

        $films = $film_service->getFilms($query, $api_key);

        if (isset($films['total_pages'])){
            if ($films['total_pages'] < 10){
                $pagerCount = $films['total_pages'];
            } else {
                $pagerCount = 10;
            }
        }

        foreach ($films['results'] as $key => $value) {
            $films['results'][$key]['raw'] = urlencode(json_encode($value));
        }

        return $this->render('film.html.twig',[
            'api_key' => $api_key,
            'films' => isset($films['results']) ? $films['results'] : null ,
            'pagerCount' => isset($pagerCount) ? $pagerCount : null,
            'selectedPage' => $page
        ]);
    }
}