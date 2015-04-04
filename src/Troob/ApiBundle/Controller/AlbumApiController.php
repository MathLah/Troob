<?php

namespace Troob\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Troob\ApiBundle\Entity\Album;

/**
 * Album controller.
 *
 */
class AlbumApiController extends Controller
{

    /**
     * Lists all Album entities.
     *
     * @Method("GET")
     * @Template()
     */
    public function getAlbumsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Album')->findAll();

        return $entities;
    }

    /**
     * Get one Album entitie by aid
     *
     * @Method("GET")
     * @Template()
     */
    public function getAlbumAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Album')->find($id);

        return $entities;
    }

    /**
     * @Method("post")
     * @param unknown $post
     */
    public function postAlbumsAction()
    {
    	$request = $this->getRequest();
    	
		$entity = new Album();
		
		$entity->setName($request->request->get('name'));
		$entity->setWikipage($request->request->get('wikipage'));
		$entity->setHomepage($request->request->get('homepage'));
		$entity->setImage($request->request->get('image'));
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
		$em->flush();
         
		return $entity;
    }
    
    /**
     * @Method("put")
     * @param unknown $post
     */
    public function putAlbumsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Album')->find($id);
    	
    	$request = $this->getRequest();

    	$entity->setName($request->request->get('name'));
    	$entity->setWikipage($request->request->get('wikipage'));
    	$entity->setHomepage($request->request->get('homepage'));
		$entity->setImage($request->request->get('image'));
    	
    	$em->persist($entity);
    	$em->flush();
    	
    	return $entity;
    }
    
    /**
     * 
     * @Method("delete")
     * @param unknown $post
     */
    public function deleteAlbumsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Album')->find($id);
    	$em->remove($entity);
    	$em->flush();
    }
}
