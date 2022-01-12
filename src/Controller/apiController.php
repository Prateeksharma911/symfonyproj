<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class apiController extends AbstractController
{
    /**
     * @Route("/product", name="product_show")
     */public function show(ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Product::class)->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        $totalproduct = count($product);
   

        // return new Response('Check out this great product: '.$product->getName().$product->getPrice());

        return new Response('Check out this great product: ' .var_dump($product));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    
}
    /**
     * @Route("/product/{id}", name="product_show_id")
     */
    public function showWithId(ManagerRegistry $doctrine , int $id): Response
     {
        $product = $doctrine->getRepository(Product::class);
        $product=$product->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
 
        return new Response('Check out this great product: ' .$product->getName());
    }
}