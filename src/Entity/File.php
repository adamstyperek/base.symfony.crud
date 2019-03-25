<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extension;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalExtenstion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OriginalFileName;

    public function __construct(string $fileName, string $extension, string $originalFileName, string $originalExtenstion, string $type)
    {
        $this->fileName = $fileName;
        $this->extension = $extension;
        $this->OriginalFileName = $originalFileName;
        $this->originalExtenstion = $originalExtenstion;
        $this->type = $type;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();        
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getOriginalExtenstion(): ?string
    {
        return $this->originalExtenstion;
    }

    public function setOriginalExtenstion(string $originalExtenstion): self
    {
        $this->originalExtenstion = $originalExtenstion;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOriginalFileName(): ?string
    {
        return $this->OriginalFileName;
    }

    public function setOriginalFileName(string $OriginalFileName): self
    {
        $this->OriginalFileName = $OriginalFileName;

        return $this;
    }

    public function getFileNameWithExtension()
    {
        return $this->fileName . '.' . $this->extension;
    }
}
