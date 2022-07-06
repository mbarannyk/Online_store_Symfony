<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    #[Route('/main', name: 'main_page')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/main/contacts', name: 'contacts')]
    public function DisplayContacts(): Response
    {
        return $this->render('contacts.html.twig');
    }
}
