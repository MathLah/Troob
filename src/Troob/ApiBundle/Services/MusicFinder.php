<?php

namespace Troob\ApiBundle\Services;

use Symfony\Component\Finder\Finder;
use Troob\ApiBundle\Entity\Band;
use Troob\ApiBundle\Entity\Album;
use Troob\ApiBundle\Entity\Music;
use Troob\ApiBundle\Entity\StoredMedia;

class MusicFinder {
	
	private $folder = '';
	private $doctrine = NULL;
	private $extention = '';
	
	private $albums = array();
	
	function __construct($folder, $extention, $doctrine) {
		$this->folder = $folder;
		$this->doctrine = $doctrine;
		$this->extention = $extention;
	}
	
	function broswe() {
		$finder = new Finder();
		$finder->files()
			->in($this->folder)
			->name("*.$this->extention");
		
		
		foreach ($finder as $file) {
			$this->createData($file);
		}

// 		$this->compare();
// 		return 
	}
	
	function compare() {
		$em = $this->doctrine->getManager();
		
		$entities = $em->getRepository('TroobApiBundle:Music')->findAll();
		
		foreach ($entities as $e) {
		}
		
		return $entities;
	}
	
	function createData($file) {
		$band = $file->getRelativePath();
		$album = "";
		if (strpos($band, '/') !== FALSE) {
			list($band, $album) = explode('/', $band);
		}
		$music = $file->getFilename();
		$band = $this->createBand($band);
		$album = $this->createAlbum($album, $band);
		$music = $this->createMusic($music, $album);
		
		$media = $this->createMedia($file, $music);
	}
	
	function createBand($band) {
		$em = $this->doctrine->getManager();
		
		$bands = $em->getRepository('TroobApiBundle:Band')->findBy(array('name' => $band));
		
		if ($bands) {
			$band = $bands[0];
		}
		else {
			$band_entity = new Band();
			$band_entity->setName($band);
			$band_entity->setHomepage("");
			$band_entity->setImage("");
			$band_entity->setWikipage("");
			$em->persist($band_entity);
			$em->flush();
			$band = $band_entity;
		}
		
		return $band;
	}
	
	function createAlbum($album, Band $band) {
		$em = $this->doctrine->getManager();
		
		$albums = $em->getRepository('TroobApiBundle:Album')->findBy(array('name' => $album));
		
		if ($albums) {
			$album = $albums[0];
		}
		else {
			$album_entity = new Album();
			$album_entity->setName($album);
			$album_entity->setBands((array($band)));
			$album_entity->setRelease(new \DateTime());
			$em->persist($album_entity);
			$em->flush();
			$album = $album_entity;
		}
		
		return $album;
	}
	
	function createMusic($music, Album $album) {
		$em = $this->doctrine->getManager();
		
		$musics = $em->getRepository('TroobApiBundle:Music')->findBy(array('name' => $music));
		
		if ($musics) {
			$music = $musics[0];
		}
		else {
			$music_entity = new Music();
			$music_entity->setName($music);
			$music_entity->setAlbums(array($album->getId() => $album));
			$em->persist($music_entity);
			$em->flush();
			$music = $music_entity;
		}
		
		return $music;
	}
	
	function createMedia($file, Music $music) {
		$em = $this->doctrine->getManager();
		
		$medias = $em->getRepository('TroobApiBundle:StoredMedia')->findBy(
				array(
						'name' => $file->getFilename(),
						'type' => $this->extention,
						'path' => $file->getRelativePath()
				)
		);
		
		if ($medias) {
			$media = $medias[0];
		}
		else {
			$media = new StoredMedia();
			$media->setMediaId($music->getId());
			$media->setName($file->getFilename());
			$media->setPath($file->getRelativePath());
			$media->setType($this->extention);
			$em->persist($media);
			$em->flush();
		}
		
		return $media;
	}
}