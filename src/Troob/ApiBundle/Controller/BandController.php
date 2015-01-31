<?php

namespace Troob\ApiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Troob\ApiBundle\Entity\Band;

/**
 * Band controller.
 *
 * @Route("/band")
 */
class BandController extends Controller
{

    /**
     * Lists all Band entities.
     *
     * @Route("/", name="band")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TroobApiBundle:Band')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Band entity.
     *
     * @Route("/{id}", name="band_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TroobApiBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
