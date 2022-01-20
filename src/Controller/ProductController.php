<?php
namespace App\Controller;

use App\Manager\ProductManager;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;


class ProductController
{

    public function getShowAction(): Response
    {
        // $ProductManager = $this->showProductFromDb();
        

        $ProductManager = $this->get('test_api.product_show');
        $showProduct= $ProductManager->showProductFromDb();

        return $showProduct;
    }


    public function getproductshowithidAction(int $id): Response
     {
        $ProductManager = $this->get('test_api.product_show');
        $product = $ProductManager->getproductofid($id);
        return $product;
        
 
    }

    public function getUpdateAction(int $id): Response
    {
        $ProductManager = $this->get('test_api.product_show');
        $product = $ProductManager->updating($id);
        
        
    }

}