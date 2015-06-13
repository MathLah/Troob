<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany as ManyToMany;
use Doctrine\ORM\Mapping\JoinTable as JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * Music
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Music
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
     * @ManyToMany(targetEntity="Album", inversedBy="Music", indexBy="aid")
     * @JoinTable(name="AssocAlbumMusic",
     *      joinColumns={@JoinColumn(name="mid", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="aid", referencedColumnName="id")}
     *      )
     */
    private $albums;
    
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
     * @return Music
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
     * Set albums
     *
     * @param string $albums
     * @return Music
     */
    public function setAlbums($albums)
    {
        $this->albums = $albums;
    
        return $this;
    }

    /**
     * Get albums
     *
     * @return string 
     */
    public function getAlbums()
    {
        return $this->albums;
    }
}
