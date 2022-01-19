<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ShowProductManager extends AbstractController
{
    /**
     * @Route("/products", name="product_show")
     */
    public function showProductFromDb(ManagerRegistry $doctrine , Request $request): Response
    {
        $product = $doctrine->getRepository(Product::class)->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        $arrayCollection = array();

        foreach($product as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'name'=>$item->getName(),
                'price'=>$item->getPrice(),
            );
        }
        
        return ($this->json($arrayCollection));

      
        // return $this->json($product);
    }
}