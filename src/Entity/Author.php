<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 * @ExclusionPolicy("ALL")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
    * @Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
      * @Expose
       * @Assert\NotBlank(groups={"Create"})
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
      * @Expose
       * @Assert\NotBlank(groups={"Create"})
     */
    private $biography;


    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author", cascade={"persist"})
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
    public function getArticles()
    {
        return $this->articles;
    }
}
