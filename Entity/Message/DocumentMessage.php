<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity\Message;

use VanDerWolf\Bundle\TelegramBundle\Entity\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\Message\DocumentMessageRepository")
 */
class DocumentMessage extends Message
{

    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\File", mappedBy="id", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    private ?File $file = null;

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->file;
    }

    /**
     * @param File $file
     * @return DocumentMessage
     */
    public function setDocument(File $file): self
    {
        $this->file = $file;
        return $this;
    }
}
