<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $Nom;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\Column(type: 'string', length: 150)]
    private $Artiste;

    #[ORM\Column(type: 'string', length: 60)]
    private $Annee;

    #[ORM\Column(type: 'datetime')]
    private $Created_at;

    #[ORM\Column(type: 'datetime')]
    private $Modified_at;

    #[ORM\OneToMany(mappedBy: 'oeuvre_id', targetEntity: Commentaire::class)]
    private $commentaire;

    #[ORM\OneToMany(mappedBy: 'oeuvre_id', targetEntity: ThemeOeuvre::class)]
    private $themeOeuvres;

    private $themes;

    private $image;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie_id;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
        $this->themeOeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getArtiste(): ?string
    {
        return $this->Artiste;
    }

    public function setArtiste(string $Artiste): self
    {
        $this->Artiste = $Artiste;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->Annee;
    }

    public function setAnnee(string $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->Created_at;
    }

    public function setCreatedAt(\DateTimeInterface $Created_at): self
    {
        $this->Created_at = $Created_at;

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

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setOeuvreId($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getOeuvreId() === $this) {
                $commentaire->setOeuvreId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ThemeOeuvre>
     */
    public function getThemeOeuvres(): Collection
    {
        return $this->themeOeuvres;
    }

    public function addThemeOeuvre(ThemeOeuvre $themeOeuvre): self
    {
        if (!$this->themeOeuvres->contains($themeOeuvre)) {
            $this->themeOeuvres[] = $themeOeuvre;
            $themeOeuvre->setOeuvreId($this);
        }

        return $this;
    }

    public function removeThemeOeuvre(ThemeOeuvre $themeOeuvre): self
    {
        if ($this->themeOeuvres->removeElement($themeOeuvre)) {
            // set the owning side to null (unless already changed)
            if ($themeOeuvre->getOeuvreId() === $this) {
                $themeOeuvre->setOeuvreId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom() . " " . $this->getDescription() . " " . $this->getArtiste();
    }

    public function getCategorieId(): ?Categorie
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?Categorie $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
