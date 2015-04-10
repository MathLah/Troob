<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Band
 *
 * @ORM\Entity
 * @ORM\Table(name="band",uniqueConstraints={@ORM\UniqueConstraint(name="name_unique", columns={"name"})})
 * 
 * @ExclusionPolicy("all")
 */
class Band
{
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Expose
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @Expose
     */
    private $name;

    /**
     * @var string
     * 
     * @ORM\Column(name="homepage", type="string", length=255)
     * 
     * @Expose
     */
    private $homepage;

    /**
     * @var string
     * 
     * @ORM\Column(name="wikipage", type="string", length=255)
     * 
     * @Expose
     */
    private $wikipage;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     *
     * @Expose
     */
    private $image;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Band
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set homepage
     *
     * @param string $homepage
     * @return Band
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    
        return $this;
    }

    /**
     * Get homepage
     *
     * @return string 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set wikipage
     *
     * @param string $wikipage
     * @return Band
     */
    public function setWikipage($wikipage)
    {
        $this->wikipage = $wikipage;
    
        return $this;
    }

    /**
     * Get wikipage
     *
     * @return string 
     */
    public function getWikipage()
    {
        return $this->wikipage;
    }

    /**
     * Set wikipage
     *
     * @param string $wikipage
     * @return Band
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get wikipage
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
