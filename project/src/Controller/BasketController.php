<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Entity\OrderProduct;
use App\Repository\OrderProductRepository;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Entity\Status;
use App\Repository\StatusRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




class BasketController extends AbstractController
{

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

    }

    /**
     * 
     * @ParamConverter("OrderProduct", Class ="App\Entity\OrderProduct")
     */
    
    #[Route('/main/basket/add/{id<\d+>}', name: 'basket_add')]
    public function BasketAdd(ProductRepository $productRepository, Product $product, EntityManagerInterface $em, $id): Response
    {


        $session = $this->requestStack->getSession();
        $sessionId = $session->getId();
        $price = $product->getPrice();
        $total_price = $price;
        $basket = new OrderProduct();
        $basket->setProduct($product);
        $basket->setSessionId($sessionId);
        $basket->setPrice($price);
        $basket->setTotalPrice($price);
        $basket->setCount(1);
        $em->persist($basket);
        $em->flush();
        return $this->redirectToRoute('basket', ['id' => $product->getId()]);
    }

    #[Route('/main/basket/del/{id<\d+>}', name: 'basket_del', methods: ['GET'])]
    public function delProduct(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(OrderProduct::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Продукт не знайдений у кошику' . $id
            );
        }
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('basket', ['id' => $product->getId()]);
    }
    
    #[Route('/main/basket', name: 'basket')]
    public function ShowBasket( OrderProductRepository $OrderProductRepository): Response
    {
      
        $session = $this->requestStack->getSession();
        $session = $session->getId();
        $products = $OrderProductRepository->findBy(['session_id' => $session]);
        // $counts = $products->getCount();

        return $this->render(
            'basket.html.twig',
            [
                'products' => $products,
                // 'counts' => $counts,
            ]
        );
    }


    #[Route('/main/basket/drop', name: 'basket_drop')]
    public function basketDrop(Request $request, EntityManagerInterface $em): Response
    {

        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add('notice', 'Profile updated');;
        $session->migrate();
        return $this->redirectToRoute('basket');

    }


}