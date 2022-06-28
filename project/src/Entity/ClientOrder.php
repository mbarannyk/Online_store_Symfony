<?php

namespace App\Entity;

use App\Repository\ClientOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientOrderRepository::class)]
class ClientOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: client::class, inversedBy: 'clientOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private $client_id;

    #[ORM\OneToOne(targetEntity: order::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $order_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?client
    {
        return $this->client_id;
    }

    public function setClientId(?client $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getOrderId(): ?order
    {
        return $this->order_id;
    }

    public function setOrderId(order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }
}
