<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use Doctrine\Common\Collections\Collection;
use VanDerWolf\Bundle\TelegramBundle\Entity\Photo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\PhotoMessageRepository")
 */
class PhotoMessage extends Message
{

    /**
     * @ORM\ManyToMany(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Photo", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="telegram_photo_telegram_message_photos",
     *      joinColumns={@ORM\JoinColumn(name="photo_message_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="photo_id", referencedColumnName="id")} )
     */
    private Collection $sizes;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $caption = null;

    public function __construct()
    {
        $this->sizes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @param Photo $size
     * @return PhotoMessage
     */
    public function addSize(Photo $size): self
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes->add($size);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return PhotoMessage
     */
    public function setCaption(string $caption = null): self
    {
        $this->caption = $caption;
        return $this;
    }
}
