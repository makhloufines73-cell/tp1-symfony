<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Titre de l'article avec les contraintes de validation
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le titre ne peut pas être vide.')]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Le titre doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $titre = null;

    // Contenu de l'article avec les contraintes de validation
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Le contenu ne peut pas être vide.')]
    #[Assert\Length(
        min: 20,
        minMessage: 'Le contenu doit contenir au moins {{ limit }} caractères.'
    )]
    private ?string $contenu = null;

    // Auteur de l'article avec les contraintes de validation
    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'L\'auteur est obligatoire.')]
    #[Assert\Regex(
    pattern: '/^[a-zA-ZÀ-ÿ\s\-]+$/',
    message: 'Le nom de l\'auteur ne peut contenir que des lettres, espaces et tirets.')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Le nom de l\'auteur doit contenir au moins {{ limit }} caractères.'
    )]
    private ?string $auteur = null;

    // Date de création avec la contrainte de validation
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message: 'La date de création est obligatoire.')]
    private ?\DateTimeInterface $dateCreation = null;

    // Statut de publication de l'article
    #[ORM\Column(type: 'boolean')]
    private bool $publie = false;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?categorie $categorie = null;

    // Getter et Setter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter et Setter pour le titre
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    // Getter et Setter pour le contenu
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }

    // Getter et Setter pour l'auteur
    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;
        return $this;
    }

    // Getter et Setter pour la date de création
    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    // Getter et Setter pour le statut de publication
    public function isPublie(): bool
    {
        return $this->publie;
    }

    public function setPublie(bool $publie): self
    {
        $this->publie = $publie;
        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}