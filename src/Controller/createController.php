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
     * @Route("/productcreate/{data}", name="product_create")
     */
    public function show(ManagerRegistry $doctrine, array $data): Response
    {
        $productadding = $doctrine->getManager();

        $product=new Product();
        $product->setName($data[0]);
        $product->setPrice($data[1]);
        $productadding->persist($product);
        $productadding->flush();
        
        return $this->redirectToRoute('product_show', [], 301);


    }
}