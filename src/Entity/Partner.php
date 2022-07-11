<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
    use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[Vich\Uploadable]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le nom d\'entreprise est obligatoire')]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'URL d\'entreprise est obligatoire')]
    private $url;

    #[ORM\Column(type: 'text', nullable: true)]
    private $recommendation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $jobTitle;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Assert\Type(\DateTimeImmutable::class)]
    private $recoDate;

      
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cover;

    // #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    // private $created_at;

    #[Vich\UploadableField(mapping: 'partners', fileNameProperty: 'cover')]
    #[Assert\Image(mimeTypesMessage: 'Ce fichier n\'est pas une image')]
    #[Assert\File(maxSize: '1M', maxSizeMessage: 'Le fichier ne doit pas dépasser les {{ limit }} {{ suffix }}',)]
    #[Assert\NotBlank(message: 'Logo d\'entreprise est obligatoire')]
    private $coverFile;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getRecommendation(): ?string
    {
        return $this->recommendation;
    }

    public function setRecommendation(?string $recommendation): self
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getRecoDate(): ?\DateTimeImmutable
    {
        return $this->recoDate;
    }

    public function setRecoDate(?\DateTimeImmutable $recoDate): self
    {
        $this->recoDate = $recoDate;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    public function setCoverFile(?File $coverFile=null): self
    {
        $this->coverFile = $coverFile;

        if ($coverFile !== null) {
            $this->updated_at = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
