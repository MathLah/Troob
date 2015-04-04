<?php

namespace Troob\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Troob\ApiBundle\Entity\Music;
use Troob\ApiBundle\Entity\Album;

/**
 * Music controller.
 *
 */
class MusicApiController extends Controller
{

    /**
     * Lists all Music entities.
     *
     * @Method("GET")
     * @Template()
     */
    public function getMusicsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Music')->findAll();

        return $entities;
    }

    /**
     * Get one Music entitie by aid
     *
     * @Method("GET")
     * @Template()
     */
    public function getMusicAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Music')->find($id);

        return $entities;
    }

    /**
     * @Method("post")
     * @param unknown $post
     */
    public function postMusicsAction()
    {
    	$request = $this->getRequest();
    	
		$entity = new Music();
		
		$entity->setName($request->request->get('name'));
    	$entity->setAlbums($this->albumsFromRequestArray($request->request->get('albums')));
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
		$em->flush();
         
		return $entity;
    }
    
    /**
     * @Method("put")
     * @param unknown $post
     */
    public function putMusicsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Music')->find($id);
    	
    	$request = $this->getRequest();

    	$entity->setName($request->request->get('name'));
    	$entity->setAlbums($this->albumsFromRequestArray($request->request->get('albums')));
    	
    	$em->persist($entity);
    	$em->flush();
    	
    	return $entity;
    }
    
    /**
     * Return an array of Album from an array of arrays
     * 
     * @param array $data_albums
     * @return array
     */
    private function albumsFromRequestArray($data_albums) {
    	$albums = array();
    	$em = $this->getDoctrine()->getManager();
    	foreach ($data_albums as $a) {
    		$album = $em->getRepository('TroobApiBundle:Album')->findOneById($a['id']);
    		$albums[] = $album;
    	}
    
    	return $albums;
    }
    
    /**
     * 
     * @Method("delete")
     * @param unknown $post
     */
    public function deleteMusicsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Music')->find($id);
    	$em->remove($entity);
    	$em->flush();
    }
}
