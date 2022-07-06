<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Entity\OrderProduct;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class OrderProductController extends AbstractController
{
   
    #[Route('/main/product_order/{id}', name: 'product_order', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function addProduct(ManagerRegistry $doctrine, int $id, Session $session): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
        $session->set('product_id', "$id");
        return $this->render('product_order.html.twig', ['product' => $product]);
    }
}