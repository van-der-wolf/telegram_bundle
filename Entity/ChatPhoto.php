<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="telegram_chat_photo")
 */
class ChatPhoto
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255, name="small_file_id")
     */
    private string $smallFileId;
    /**
     * @ORM\Column(type="string", length=255, name="small_file_unique_id")
     */
    private string $smallFileUniqueId;
    /**
     * @ORM\Column(type="string", length=255, name="big_file_id")
     */
    private string $bigFileId;
    /**
     * @ORM\Column(type="string", length=255, name="big_file_unique_id")
     */
    private string $bigFileUniqueId;

    public function __construct(string $smallFileId, string $smallFileUniqueId, string $bigFileId, string $bigFileUniqueId)
    {
        $this->smallFileId = $smallFileId;
        $this->smallFileUniqueId = $smallFileUniqueId;
        $this->bigFileId = $bigFileId;
        $this->bigFileUniqueId = $bigFileUniqueId;
    }

}