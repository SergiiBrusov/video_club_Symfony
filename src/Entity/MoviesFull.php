<?php

namespace App\Entity;

use App\Repository\MoviesFullRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoviesFullRepository::class)]
class MoviesFull
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    private ?string $genres = null;

    #[ORM\Column(length: 255)]
    private ?string $directors = null;

    #[ORM\Column(length: 255)]
    private ?string $casting = null;

    #[ORM\Column(length: 255)]
    private ?string $writers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    public function getDirectors(): ?string
    {
        return $this->directors;
    }

    public function setDirectors(string $directors): static
    {
        $this->directors = $directors;

        return $this;
    }

    public function getCasting(): ?string
    {
        return $this->casting;
    }

    public function setCasting(string $casting): static
    {
        $this->casting = $casting;

        return $this;
    }

    public function getWriters(): ?string
    {
        return $this->writers;
    }

    public function setWriters(string $writers): static
    {
        $this->writers = $writers;

        return $this;
    }
}
