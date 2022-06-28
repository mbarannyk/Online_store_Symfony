<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    #[Route('/main/products', name: 'products', methods: ['GET'])]
    public function ProductsPage(): Response
    {
        
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

    // #[Route('/main/фрукти', name: 'fruits', methods: ['GET'])]
    // #[Route('/main/овочі', name: 'vegetables', methods: ['GET'])]
    // public function findByExampleField(Request $request, ProductRepository $ProductRepository): Response
    // {
    //     $fruits = $this->ProductRepository->findByExampleField($request->query->get(category.name));
    //     return $this->render('fruits.html.twig', ['fruits' => $fruits]);
    //     $vegetables = $this->ProductRepository->findByExampleField($request->query->get('овочі'));
    //     return $this->render('vegetables.html.twig', ['vegetables' => $vegetables]);
    // }

    // #[Route('/main/овочі', name: 'vegetables', methods: ['GET'])]
    // public function findByExampleField(Request $request, ProductRepository $ProductRepository): Response
    // {
    //     $vegetables = $this->ProductRepository->findByExampleField($request->query->get('овочі'));
    //     return $this->render('vegetables.html.twig', ['vegetables' => $vegetables]);
    // }
}
