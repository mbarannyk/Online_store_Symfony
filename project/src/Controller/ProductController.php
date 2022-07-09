<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

    }

    #[Route('/main/products', name: 'products', methods: ['GET'])]
    public function ProductsPage(ProductRepository $ProductRepository): Response
    {
        $this->ProductRepository = $ProductRepository;
        $products = $this->ProductRepository->findAll();
        return $this->render('products_list.html.twig', ['products' => $products]);
    }

    #[Route('/main/фрукти', name: 'fruits')]
    public function shopFruits(ProductRepository $ProductRepository): Response
    {
        $products = $ProductRepository->findAll();
        return $this->render('fruits.html.twig', ['products' => $products]);
    }
    #[Route('/main/овочі', name: 'vegetables')]
    public function shopVegetables(ProductRepository $ProductRepository): Response
    {
        $products = $ProductRepository->findAll();
        return $this->render('vegetables.html.twig', ['products' => $products]);
    }

    #[Route('/main/{id}', name: 'product_card', requirements: ['id' => '\d+'])]
    public function product_card(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
        return $this->render('product_card.html.twig', ['product' => $product]);
    }

}
