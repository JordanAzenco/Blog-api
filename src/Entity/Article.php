<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
* @ExclusionPolicy("ALL")

*/
class Article
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    *
     * @Expose
    */
    private $id;
    
    /**
    * @ORM\Column(type="string", length=100)
    * @Expose
    * @Assert\NotBlank(groups={"Create"})
    */
    private $title;
    
    /**
    * @ORM\Column(type="string", length=1000)
     * @Expose
     * @Assert\NotBlank(groups={"Create"})
    */
    private $content;
    
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Author", cascade={"all"}, fetch="EAGER")
     * @Serializer\Expose
     * @Assert\NotBlank(groups={"Create"})
    */
    private $author;
    
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
    
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function setContent(string $content): self
    {
        $this->content = $content;
        
        return $this;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }
}
