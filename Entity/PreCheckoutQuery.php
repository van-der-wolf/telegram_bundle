<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_pre_checkout_query")
 */
class PreCheckoutQuery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\ManyToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     */
    private User $user;
    /**
     * @ORM\Column(type="string", length=3, name="currency")
     */
    private string $currency;
    /**
     * @ORM\Column(type="integer", name="total_amount")
     */
    private int $totalAmount;
    /**
     * @ORM\Column(type="text", name="invoice_payload")
     */
    private string $invoicePayload;
    /**
     * @ORM\Column(type="string", length=128, name="shipping_option_id")
     */
    private ?string $shippingOptionId = null;

    private ?OrderInfo $orderInfo;
}