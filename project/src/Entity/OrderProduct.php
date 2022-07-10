<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderProductRepository::class)]
class OrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $count;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $total_price;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'order_product')]
    private $OrderProduct;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $session_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getOrderProduct(): ?Order
    {
        return $this->OrderProduct;
    }

    public function setOrderProduct(?Order $OrderProduct): self
    {
        $this->OrderProduct = $OrderProduct;

        return $this;
    }

    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    public function setSessionId(?string $session_id): self
    {
        $this->session_id = $session_id;

        return $this;
    }

}
