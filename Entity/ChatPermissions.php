<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_chat_permissions")
 */
class ChatPermissions
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="boolean", name="can_send_messages")
     */
    private ?bool $canSendMessages;
    /**
     * @ORM\Column(type="boolean", name="can_send_media_messages")
     */
    private ?bool $canSendMediaMessages;
    /**
     * @ORM\Column(type="boolean", name="can_send_polls")
     */
    private ?bool $canSendPolls;
    /**
     * @ORM\Column(type="boolean", name="can_send_other_messages")
     */
    private ?bool $canSendOtherMessages;
    /**
     * @ORM\Column(type="boolean", name="can_add_web_page_previews")
     */
    private ?bool $canAddWebPagePreviews;
    /**
     * @ORM\Column(type="boolean", name="can_change_info")
     */
    private ?bool $canChangeInfo;
    /**
     * @ORM\Column(type="boolean", name="can_invite_users")
     */
    private ?bool $canInviteUsers;
    /**
     * @ORM\Column(type="boolean", name="can_pin_messages")
     */
    private ?bool $canPinMessages;


}