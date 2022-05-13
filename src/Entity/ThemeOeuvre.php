<?php

namespace App\Entity;

use App\Repository\ThemeOeuvreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeOeuvreRepository::class)]
class ThemeOeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Theme::class, inversedBy: 'themeOeuvres')]
    #[ORM\JoinColumn(nullable: false)]
    private $theme_id;

    #[ORM\ManyToOne(targetEntity: Oeuvre::class, inversedBy: 'themeOeuvres')]
    #[ORM\JoinColumn(nullable: false)]
    private $oeuvre_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThemeId(): ?Theme
    {
        return $this->theme_id;
    }

    public function setThemeId(?Theme $theme_id): self
    {
        $this->theme_id = $theme_id;

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

    public function __toString()
    {
        return $this->getThemeId();
    }
}
