<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\OrderProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function default(OrderProductRepository $OrderProductRepository, OrderRepository $OrderRepository, ProductRepository  $ProductRepository): Response
    {
        $orders = $OrderRepository->findAll();
        $basket = $OrderProductRepository->findAll();
        $products = $ProductRepository->findAll();
        return $this->render('profile.html.twig',
            [
                'controller_name' => 'ProfileController',
                'orders' => $orders,
                'basket' => $basket,
                'products' => $products,
                'user' => $this->getUser(),
            ]
        );
    }


}