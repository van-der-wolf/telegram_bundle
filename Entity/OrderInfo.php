<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_order_info")
 */
class OrderInfo
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255, name="name", nullable=true)
     */
    private ?string $name = null;
    /**
     * @ORM\Column(type="string", length=255, name="phone_number", nullable=true)
     */
    private ?string $phoneNumber = null;
    /**
     * @ORM\Column(type="string", length=255, name="email", nullable=true)
     */
    private ?string $email = null;
    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\ShippingAddress")
     */
    private ?ShippingAddress $shippingAddress = null;

}