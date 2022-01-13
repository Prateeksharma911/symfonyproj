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
        // return new Response($product);
        $allProducts = array();
        // $i = 0;
        // while ($i < $totalproduct)
        // {
        //     $allProducts[] =  $allProducts[$i] ;
        //     $i++;
        // }
        foreach ($product as $prod)  {
            $allProducts[] =  $prod;
        }
        // return $this->json(['products'=>$allProducts]);

        return new Response('Check out this great product: ' .json_encode($allProducts));
        
    
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