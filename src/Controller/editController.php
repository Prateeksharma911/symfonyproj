<?php
namespace App\Controller;

use App\Entity\Product;
use Doctrine\DBAL\Schema\View;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class editController extends AbstractController
{
    /**
     * @Route("/productsedit/{id}" , name="Product_edit")
     */
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class);
        $product=$product->find($id);
        // $name = $request->get('name');
        // $price = $request->get('price');
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found id '
            );
        }
        return new Response('Product Added ' .$product->getName());
     
        //     if (empty($user)) {
        //         return new View("user not found", Response::HTTP_NOT_FOUND);
        //     } 
        //     elseif(!empty($name) && !empty($price)){
        //         $user->setName($name);
        //         $user->setPrice($price);
        //         $sn->flush();
        //         return new View("User Updated Successfully", Response::HTTP_OK);
        //     }
        //     elseif(empty($name) && !empty($price)){
        //         $user->setPrice($price);
        //         $sn->flush();
        //         return new View("price Updated Successfully", Response::HTTP_OK);
        //     }
        //     elseif(!empty($name) && empty($price)){
        //         $user->setName($name);
        //         $sn->flush();
        //         return new View("User Name Updated Successfully", Response::HTTP_OK); 
        //     }
        //     else return new Response('Product Added ' .$user->getName());
        }
        
        // return $this->createNotFoundException('No product found for id '.$id);
        // return $this->redirectToRoute('product_show', [
        //     'id' => $product->getId()
        // ]);
}