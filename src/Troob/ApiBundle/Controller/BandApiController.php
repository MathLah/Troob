<?php

namespace Troob\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Troob\ApiBundle\Entity\Band;
use Troob\ApiBundle\Form\BandType;

/**
 * Band controller.
 *
 */
class BandApiController extends Controller
{

    /**
     * Lists all Band entities.
     *
     * @Method("GET")
     * @Template()
     */
    public function getBandsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Band')->findAll();

        return $entities;
    }

    /**
     * Get one Band entitie by aid
     *
     * @Method("GET")
     * @Template()
     */
    public function getBandAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Band')->find($id);

        return $entities;
    }

    /**
     * @Method("post")
     * @param unknown $post
     */
    public function postBandsAction()
    {
    	$request = $this->getRequest();
    	
		$entity = new Band();
		
		$entity->setName($request->request->get('name'));
		$entity->setWikipage($request->request->get('wikipage'));
		$entity->setHomepage($request->request->get('homepage'));

		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
		$em->flush();
         
		return $entity;
    }
    
    /**
     * @Method("put")
     * @param unknown $post
     */
    public function putBandsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Band')->find($id);
    	
    	$request = $this->getRequest();

    	$entity->setName($request->request->get('name'));
    	$entity->setWikipage($request->request->get('wikipage'));
    	$entity->setHomepage($request->request->get('homepage'));
    	
    	$em->persist($entity);
    	$em->flush();
    	
    	return $entity;
    }
    
    /**
     * 
     * @Method("delete")
     * @param unknown $post
     */
    public function deleteBandsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('TroobApiBundle:Band')->find($id);
    	$em->remove($entity);
    	$em->flush();
    }
}
