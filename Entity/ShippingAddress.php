<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_shipping_address")
 */
class ShippingAddress
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=3, name="country_code")
     */
    private string $countryCode;
    /**
     * @ORM\Column(type="string", length=512, name="state")
     */
    private string $state;
    /**
     * @ORM\Column(type="string", length=512, name="city")
     */
    private string $city;
    /**
     * @ORM\Column(type="string", length=255, name="street_line1")
     */
    private string $streetLine1;
    /**
     * @ORM\Column(type="string", length=255, name="street_line2")
     */
    private string $streetLine2;
    /**
     * @ORM\Column(type="string", length=255, name="post_code")
     */
    private string $postCode;

}