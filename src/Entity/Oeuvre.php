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

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $artiste;

    #[ORM\Column(type: 'integer')]
    private $année;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'ctg_ovr', targetEntity: Categorie::class)]
    private $categories;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'oeuvres')]
    private $thm_ovr;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'thm_ovr')]
    private $oeuvres;

    #[ORM\OneToMany(mappedBy: 'oeuvre', targetEntity: Commentaire::class)]
    private $ovr_cmt;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->thm_ovr = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
        $this->ovr_cmt = new ArrayCollection();
    }

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

    public function getArtiste(): ?string
    {
        return $this->artiste;
    }

    public function setArtiste(string $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getAnnée(): ?int
    {
        return $this->année;
    }

    public function setAnnée(int $année): self
    {
        $this->année = $année;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setCtgOvr($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCtgOvr() === $this) {
                $category->setCtgOvr(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getThmOvr(): Collection
    {
        return $this->thm_ovr;
    }

    public function addThmOvr(self $thmOvr): self
    {
        if (!$this->thm_ovr->contains($thmOvr)) {
            $this->thm_ovr[] = $thmOvr;
        }

        return $this;
    }

    public function removeThmOvr(self $thmOvr): self
    {
        $this->thm_ovr->removeElement($thmOvr);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(self $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres[] = $oeuvre;
            $oeuvre->addThmOvr($this);
        }

        return $this;
    }

    public function removeOeuvre(self $oeuvre): self
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            $oeuvre->removeThmOvr($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getOvrCmt(): Collection
    {
        return $this->ovr_cmt;
    }

    public function addOvrCmt(Commentaire $ovrCmt): self
    {
        if (!$this->ovr_cmt->contains($ovrCmt)) {
            $this->ovr_cmt[] = $ovrCmt;
            $ovrCmt->setOeuvre($this);
        }

        return $this;
    }

    public function removeOvrCmt(Commentaire $ovrCmt): self
    {
        if ($this->ovr_cmt->removeElement($ovrCmt)) {
            // set the owning side to null (unless already changed)
            if ($ovrCmt->getOeuvre() === $this) {
                $ovrCmt->setOeuvre(null);
            }
        }

        return $this;
    }
}
