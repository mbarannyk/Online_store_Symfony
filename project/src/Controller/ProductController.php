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

    #[Route('/main/fruits', name: 'fruits', methods: ['GET'])]
    public function findByExampleField(Request $request, ProductRepository $ProductRepository): Response
    {
        $fruits = $this->ProductRepository->findByExampleField($request->query->get('фрукти'));
        return $this->render('fruits.html.twig', ['fruits' => $fruits]);
    }
}
