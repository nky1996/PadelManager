<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class FilmService {
    private $em;
    private $url;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->url = "https://api.themoviedb.org/3/";
    }
    public function getFilms($query, $api_key) {
        $url = $this->url . $query . '&api_key=' . $api_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return json_decode($server_output,true);
    }
}