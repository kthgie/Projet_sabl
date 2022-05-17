<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $Nom;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\Column(type: 'datetime')]
    private $Created_at;

    #[ORM\Column(type: 'datetime')]
    private $Modified_at;

    #[ORM\OneToMany(mappedBy: 'theme_id', targetEntity: ThemeOeuvre::class)]
    private $themeOeuvres;

    private $oeuvres;

    public function __construct()
    {
        $this->themeOeuvres = new ArrayCollection();
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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
            $themeOeuvre->setThemeId($this);
        }

        return $this;
    }

    public function removeThemeOeuvre(ThemeOeuvre $themeOeuvre): self
    {
        if ($this->themeOeuvres->removeElement($themeOeuvre)) {
            // set the owning side to null (unless already changed)
            if ($themeOeuvre->getThemeId() === $this) {
                $themeOeuvre->setThemeId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
