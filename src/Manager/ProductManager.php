<?php
namespace App\Manager;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProductManager extends AbstractController
{

    protected $doctrine;

    public function __construct(
        ManagerRegistry $doctrine
    ) {
    }

    public function showProductFromDb(Request $request): Response
    {
        $product = $this->doctrine->getRepository(Product::class)->findAll();

        if (!$product) {
            
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        // Adding DB data to an array to pass it as json
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

// Sow Product of ID
    public function getproductofid($id): Response
    {
        $product = $this->doctrine->getRepository(Product::class);
        $product=$product->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
 
        return new Response('Check out this great product: ' .$product->getName());
    }
    // Update Product
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

}