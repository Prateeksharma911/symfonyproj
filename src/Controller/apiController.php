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

        $arrayCollection = array();

        foreach($product as $item) {
            $arrayCollection[] = array(
                'id' => $item->getId(),
                'name'=>$item->getName(),
                'price'=>$item->getPrice(),
            );
        }
        
        return ($this->json($arrayCollection));

        return new Response('Check out this great product: ' .dd($product));
        // return $this->json($product);
    }
      /**
     * @Route("/productseditng/{id}" , name="Product_editing")
     */
    public function updating(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        $sn = $this->getDoctrine()->getManager();
        $product = $doctrine->getRepository(Product::class);
        $product=$product->find($id);
        $name = $request->get('name');
        $price = $request->get('price');

        if (empty($product)) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
          } 
         elseif(!empty($name) && !empty($price)){
            $product->setName($name);
            $product->setPrice($price);
            $sn->flush();
            return new Response("User Updated Successfully", Response::HTTP_OK);
          }
         elseif(empty($name) && !empty($price)){
            $product->setPrice($price);
            $sn->flush();
            return new Response("Price Updated Successfully", Response::HTTP_OK);
         }
         elseif(!empty($name) && empty($price)){
          $product->setName($name);
          $sn->flush();
          return new Response("Product Name Updated Successfully", Response::HTTP_OK); 
         }
         else return new Response("Product name or price cannot be empty", Response::HTTP_NOT_ACCEPTABLE); 
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
    /**
     * @Route("/expensiveproducts", name="expensive_product_show")
     */
    public function expensiveProduct(ManagerRegistry $doctrine ,Request $request): Response
     {
        $conn=$this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM `product` WHERE price>25000';
        $stmt =$conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->findAll();
        // print_r($result);
        // var_dump($stmt->findAll());die;
        // return new Response('Check out this great product: ' ($stmt));
 

        // var_dump($conn);die;
        //---
        // $arrayCollection = array();
        // foreach($result as $item) {
        //     $arrayCollection[] = array(
        //         'id' => $item->getId(),
        //         'name'=>$item->getName(),
        //         'price'=>$item->getPrice(),
        //     );
        // }
        return new Response($this->json($stmt));
        // return ($this->json($arrayCollection));

    }
    
}