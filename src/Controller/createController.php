<?php
namespace App\Controller;

use App\Entity\Product;
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
    public function show(ManagerRegistry $doctrine): Response
    {
        $productadding = $doctrine->getManager();

        $product=new Product();
        $product->setName('Apple');
        $product->setPrice('59999');
        $productadding->persist($product);
        $productadding->flush();
        
        return $this->redirectToRoute('product_show', [], 301);


    }
}