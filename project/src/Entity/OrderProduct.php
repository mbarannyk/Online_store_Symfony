<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
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
    private $product_id;

    #[ORM\ManyToOne(targetEntity: order::class, inversedBy: 'orderProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $order_id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $count;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $total_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?product
    {
        return $this->product_id;
    }

    public function setProductId(?product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOrderId(): ?order
    {
        return $this->order_id;
    }

    public function setOrderId(?order $order_id): self
    {
        $this->order_id = $order_id;

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
}
