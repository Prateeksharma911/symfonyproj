<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/normal")
     */
    public function normal(){
        
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
    public function update($idupdate)
    {
        $answers = [
            'Rolls-Royce was a British luxury car and later an aero-engine manufacturing business established in 1904 in Manchester',
            'Building on Royce reputation established with his cranes they quickly developed a reputation for superior engineering by manufacturing the "best car in the world".',' The First World War brought them into manufacturing aero-engines. Joint development of jet engines began in 1940'

        ];
        dump($this);
        return $this->render('index/test.html.twig', [
            'update' => $idupdate,  
            'answers' => $answers,
        ]);
        // return new Response(sprintf(
        //     'update %s',$idupdate
        // ));
    }
}