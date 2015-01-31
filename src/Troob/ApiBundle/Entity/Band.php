<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Band
 */
class Band
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var string
     */
    private $wikipage;


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
}
