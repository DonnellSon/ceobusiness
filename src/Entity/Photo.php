<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: PhotoRepository::class)]
#[Vich\Uploadable]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'photo', cascade: ['persist', 'remove'])]
    private ?PersoInfos $persoInfos = null;


    #[ORM\Column(length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(length: 255)]
    private ?string $fileSize = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $fileUrl = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Vich\UploadableField(mapping: 'photo_upload', fileNameProperty: 'fileName', size: 'fileSize')]
    private ?File $file = null;

    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreFlush]
    public function generateFileUrl(): ?string
    {
        if ($this->getFileName()) {
            $siteDomain = $_ENV['SITE_DOMAIN'] ?? null;
            if ($siteDomain) {
                $this->setFileUrl($siteDomain . '/upload/img/photos/' . $this->getFileName());
            }
        }
        return null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersoInfos(): ?PersoInfos
    {
        return $this->persoInfos;
    }

    public function setPersoInfos(?PersoInfos $persoInfos): static
    {
        // unset the owning side of the relation if necessary
        if ($persoInfos === null && $this->persoInfos !== null) {
            $this->persoInfos->setPhoto(null);
        }

        // set the owning side of the relation if necessary
        if ($persoInfos !== null && $persoInfos->getPhoto() !== $this) {
            $persoInfos->setPhoto($this);
        }

        $this->persoInfos = $persoInfos;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of FileSize
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set the value of FileSize
     *
     * @return  self
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(?string $fileUrl): static
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): static
    {
        $this->file = $file;

        return $this;
    }

    
}
