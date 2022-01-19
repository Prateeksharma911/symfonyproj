<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ShowProductController extends AbstractController
{
    /**
     * @Route("/products", name="product_show")
     */
    public function getshowAction(ManagerRegistry $doctrine , Request $request): Response
    {
        $showProductManager = $this->get('test_api.product_show');
        $showProduct= $showProductManager->showProductFromDb();

        return $showProduct;
        
        
    }
}