<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany as ManyToMany;
use Doctrine\ORM\Mapping\JoinTable as JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Album
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release", type="date")
     */
    private $release;    
    
	/**
     * @ManyToMany(targetEntity="Band")
     * @JoinTable(name="AssocAlbumBand",
     *      joinColumns={@JoinColumn(name="aid", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="bid", referencedColumnName="id")}
     *      )
     */
    private $bands;

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
     * @return Album
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
     * Set release
     *
     * @param \DateTime $release
     * @return Album
     */
    public function setRelease($release)
    {
        $this->release = $release;
    
        return $this;
    }

    /**
     * Get release
     *
     * @return \DateTime 
     */
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * Set bands
     *
     * @param string $bands
     * @return Album
     */
    public function setBands($bands)
    {
    	$this->bands = $bands;
    
    	return $this;
    }
    
    /**
     * Get bands
     *
     * @return string
     */
    public function getBands()
    {
    	return $this->bands;
    }
}
