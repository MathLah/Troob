<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;

/**
 * AssocAlbumMusic
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="assoc_album_music", columns={"aid", "mid"})})
 * @ORM\Entity
 */
class AssocAlbumMusic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aid", type="integer")
     * @ORM\Id
     */
    private $aid;

    /**
     * @var integer
     * @ORM\Id
     *
     * @ORM\Column(name="mid", type="integer")
     */
    private $mid;

    /**
     * Set aid
     *
     * @param integer $aid
     * @return AssocAlbumMusic
     */
    public function setAid($aid)
    {
    	$this->aid = $aid;
    
    	return $this;
    }

    /**
     * Get aid
     *
     * @return integer 
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set bid
     *
     * @param integer $mid
     * @return AssocAlbumMusic
     */
    public function setMid($mid)
    {
        $this->mid = $mid;
    
        return $this;
    }

    /**
     * Get mid
     *
     * @return integer 
     */
    public function getMid()
    {
        return $this->mid;
    }
}
