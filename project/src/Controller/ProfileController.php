<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function UserOrders(): Response
    {
        return $this->render('profile.html.twig',
            [
                'controller_name' => 'ProfileController',
                'user' => $this->getUser(),
            ]
        );
    }


}