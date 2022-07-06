<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Entity\OrderProduct;
use App\Repository\OrderProductRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class BasketController extends AbstractController
{

    #[Route('/main/basket/add/{id<\d+>}', name: 'basket_add')]
    public function addProduct(ManagerRegistry $doctrine, EntityManagerInterface $em, ProductRepository $productRepository, OrderProductRepository $OrderProductRepository, Session $session, int $id): Response
    {
        
        $em= $doctrine->getManager();
        $product = $doctrine->getRepository(Product::class)->find($id);
        $OrderProduct = new OrderProduct();
        $price = $product->getPrice();
        $total_price = $price;
        $OrderProduct -> setProduct($product)
        ->setPrice($price)
        -> setCount(1)
        ->setTotalPrice($total_price);

        $session->set('orderProductId', $OrderProduct -> getId());

        $em->persist($OrderProduct);
        $em->flush();
        return $this->redirectToRoute('basket');
    }

    #[Route('/main/basket/del/{id<\d+>}', name: 'basket_del', methods: ['GET'])]
    public function delProduct(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Продукт не знайдений у кошику' . $id
            );
        }
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->render('basket.html.twig', ['product' => $product]);
    }
    
    #[Route('/main/basket', name: 'basket')]
    public function ShowBasket(Session $session, ProductRepository $productRepository, OrderProductRepository $OrderProductRepository, OrderProduct $OrderProduct): Response
    {
        $id = $session->get('orderProductId');
        $OrderProducts = $OrderProductRepository->find($id);
        $products = $OrderProducts -> getProduct();
        return $this->render('basket.html.twig', ['products' => $products]);
    }

    #[Route('/main/order', name: 'order')]
    public function SetOrder(ManagerRegistry $doctrine, Session $session): Response
    {
        return $this->render('index.html.twig');
        $session->clear();
    }


}