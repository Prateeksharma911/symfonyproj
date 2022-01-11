<?php
namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class insertController extends AbstractController
{
    /**
     * @Route("/pager")
     */
    public function homepage(){
        
        return new Response('new page');
    }
    /**
     * @Route("/create")
     */
    public function create(Request $request){
        $crud = new Product();
        $form = $this->createForm(ProductformType::class,$crud);
        $form->handleRequest($request);
        return $this->render('index/show.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
}