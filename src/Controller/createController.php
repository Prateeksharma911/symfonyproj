<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\DBAL\Schema\View;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class createController extends AbstractController
{
    /**
     * @Route("/productcreate", name="product_create")
     */
    public function show(Request $request)
    {
        $product=new Product();
        $name = $request->get('name');
        $price = $request->get('price');
      if(empty($name) || empty($price))
      {
        // return $this->redirectToRoute('product_show', [], 301);
        return new Response('Product can\'t be added');
      } 
       $product->setName($name);
       $product->setPrice($price);
       $em = $this->getDoctrine()->getManager();
       $em->persist($product);
       $em->flush();
    //    return $this->redirectToRoute('product_show', [], 301);
    return new Response('Product Added ' .$product->getName());
    }
}