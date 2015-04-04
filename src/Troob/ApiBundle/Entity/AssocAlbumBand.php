<?php

namespace Troob\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;

/**
 * AssocAlbumBand
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="assoc_album_band", columns={"aid", "bid"})})
 * @ORM\Entity
 */
class AssocAlbumBand
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
     * @ORM\Column(name="bid", type="integer")
     */
    private $bid;

    /**
     * Set aid
     *
     * @param integer $aid
     * @return AssocAlbumBand
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
     * @param integer $bid
     * @return AssocAlbumBand
     */
    public function setBid($bid)
    {
        $this->bid = $bid;
    
        return $this;
    }

    /**
     * Get bid
     *
     * @return integer 
     */
    public function getBid()
    {
        return $this->bid;
    }
}
