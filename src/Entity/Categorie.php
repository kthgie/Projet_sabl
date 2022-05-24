<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Oeuvre::class, inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: true)]
    private $ctg_ovr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCtgOvr(): ?Oeuvre
    {
        return $this->ctg_ovr;
    }

    public function setCtgOvr(?Oeuvre $ctg_ovr): self
    {
        $this->ctg_ovr = $ctg_ovr;

        return $this;
    }
}
