<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Entity\Status;
use App\Form\OrderFormType;
use App\Repository\OrderProductRepository;
use App\Repository\ProductRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    #[Route('/main/order', name: 'order')]
    public function Order(Request $request, EntityManagerInterface $em, ManagerRegistry $doctrine, OrderProductRepository $OrderProductRepository) : Response
    {

        $session = $this->requestStack->getSession();
        $session = $session->getId();
        $products = $OrderProductRepository->findOneBy(['session_id' => $session]);
        $totalPrice = $products->getTotalPrice();

        $order = new Order();
        $form = $this->createForm(OrderFormType::class, $order);
        $status = $doctrine->getRepository(Status::class)->find($id = 1);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();

            if ($order instanceof Order) {
                $session = $this->requestStack->getSession();

                if ($this->getUser()) {
                    $Order->setUser($this->getUser()->getId());
                }
                $sessionId = $session->getId();

                $order->setStatus($status);
                $order->setTotalPrice($totalPrice);
                $em->persist($order);
                $em->flush();
                $session->migrate();
              
            }

            return $this->redirectToRoute('basket');
        }


        return $this->render(
            'order.html.twig',
            [
                'form' => $form->createView(),
                'order' => $order
            ]
        );
    }

}
