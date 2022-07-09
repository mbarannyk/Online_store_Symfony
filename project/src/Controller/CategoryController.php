<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private CategoryRepository $CategoryRepository;

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

    }

    #[Route('/main/categories', name: 'categories', methods: ['GET'])]
    public function CategoriesPage(CategoryRepository $CategoryRepository): Response
    {
        $this->CategoryRepository = $CategoryRepository;
        $categories = $this->CategoryRepository->findAll();
        return $this->render('category.html.twig', ['categories' => $categories]);
    }
}
