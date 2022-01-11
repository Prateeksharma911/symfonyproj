<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/")
     */
    public function homepage(){
        return new Response('Hello');
    }
    /**
     * @Route("/insert")
     */
    public function insert(){
        return new Response('Insertion');
    }
    /**
     * @Route("/update/{idupdate}")
     */
    public function update($idupdate){
        return new Response(sprintf(
            'update %s',$idupdate
        ));
    }
}