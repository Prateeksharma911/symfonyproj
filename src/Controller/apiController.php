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
     * @Route("/products", name="product_show")
     */
    public function show(ManagerRegistry $doctrine , Request $request): Response
    {
        $product = $doctrine->getRepository(Product::class)->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        $totalproduct = count($product);
        // return new Response($product);
        return $this->json($product);
        // $i = 0;
        // while ($i < $totalproduct)
        // {
        //     $allProducts[] =  $allProducts[$i] ;
        //     $i++;
        // }
        // foreach ($product as $prod)  {
        //     $allProducts[] =  $prod;
        // }
        // return $this->json(['products'=>$allProducts]);

        // return new Response('Check out this great product: ' .dd($allProducts));
        
    
}
    /**
     * @Route("/products/{id}", name="product_show_id")
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