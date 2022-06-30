<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Http\SpecialRequest;

use Symfony\Component\HttpFoundation\Cookie;


$response = new Response(
    'quantity',
    Response::HTTP_OK,
    ['content-type' => 'text/html']
);
$response->headers->setCookie(Cookie::create('quantity'));

class BasketController extends AbstractController
{
   
    #[Route('/main/basket/{id<\d+>}', name: 'basket')]
    public function addProduct(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);
        return $this->render('basket.html.twig', ['product' => $product]);
    }

}