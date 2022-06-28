<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    
    #[Route('/main/search', name: 'search')]
    public function search(Request $request, ProductRepository $ProductRepository): Response
    {
        $request = Request::createFromGlobals();
        $products = $ProductRepository->search($request->query->get('name'));
        if (count($this->search($request->query->get('name')) > 0)) {
           return $this->render('search.html.twig', ['products' => $products]);
        } else {
            return $this->render('contacts.html.twig');      
        }
        
    }
}
