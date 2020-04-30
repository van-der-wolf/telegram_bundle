<?php
declare(strict_types=1);

namespace VanDerWolf\Bundle\TelegramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VanDerWolf\Bundle\TelegramBundle\Repository\Telegram\FileRepository")
 * @ORM\Table(name="telegram_file")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $fileId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $mimeType;

    /**
     * @ORM\Column(type="integer")
     */
    private int $fileSize;

    /**
     * @ORM\OneToOne(targetEntity="VanDerWolf\Bundle\TelegramBundle\Entity\Photo", cascade={"persist", "remove"})
     */
    private ?Photo $thumb = null;

    public function getId()
    {
        return $this->id;
    }

    public function getFileId(): ?string
    {
        return $this->fileId;
    }

    public function setFileId(string $fileId): self
    {
        $this->fileId = $fileId;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getThumb(): ?Photo
    {
        return $this->thumb;
    }

    public function setThumb(?Photo $thumb): self
    {
        $this->thumb = $thumb;

        return $this;
    }
}
