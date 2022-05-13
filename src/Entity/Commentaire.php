<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $Modified_at;

    #[ORM\ManyToOne(targetEntity: Oeuvre::class, inversedBy: 'commentaire')]
    #[ORM\JoinColumn(nullable: false)]
    private $oeuvre_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->Modified_at;
    }

    public function setModifiedAt(\DateTimeInterface $Modified_at): self
    {
        $this->Modified_at = $Modified_at;

        return $this;
    }

    public function getOeuvreId(): ?Oeuvre
    {
        return $this->oeuvre_id;
    }

    public function setOeuvreId(?Oeuvre $oeuvre_id): self
    {
        $this->oeuvre_id = $oeuvre_id;

        return $this;
    }
}
