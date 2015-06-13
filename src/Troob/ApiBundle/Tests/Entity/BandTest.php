<?php

namespace Troob\ApiBundle\Tests\Entity;

use Troob\ApiBundle\Entity\Band;
class BandTest extends \PHPUnit_Framework_TestCase {
	
	protected static $kernel;
	protected static $container;
	
	private $entityManager;
	
	public function __construct() {
		
	}
	
	public function get($id)
    {
      return self::$kernel->getContainer()->get($id);
    }
	
	public static function setUpBeforeClass() {
		self::$kernel = new \AppKernel('dev', true);
		self::$kernel->boot();
		self::$container = self::$kernel->getContainer();
		
	}
	
	public function setUp() {
		parent::setUp();
		
		$this->entityManager = self::$container->get('doctrine')->getManager();
	}
	
	public function testCreateBand() {
		$v = $this->get('validator');
		
		$band = new Band();
		$band->setName('Mock Band Test');
		$band->setHomepage('http://mocksingertest.homepage.com');
		$band->setWikipage('http://mocksingertest.wikipage.com');
		$band->setImage('mocksingertest_image');
		
		$errors = $v->validate($band);
		$this->assertEquals(0, count($errors));
		
		$this->assertAttributeContains('Mock Band Test', 'name', $band);
		$this->assertAttributeContains('http://mocksingertest.homepage.com', 'homepage', $band);
		$this->assertAttributeContains('http://mocksingertest.wikipage.com', 'wikipage', $band);
		$this->assertAttributeContains('mocksingertest_image', 'image', $band);
		
		$this->entityManager->persist($band);
		$this->entityManager->flush();
	}
	
	public function testGetBand() {
		$band = $this->entityManager->getRepository('TroobApiBundle:Band')->findOneByName('Mock Band Test');
		
		$this->assertAttributeContains('Mock Band Test', 'name', $band);
		$this->assertAttributeContains('http://mocksingertest.homepage.com', 'homepage', $band);
		$this->assertAttributeContains('http://mocksingertest.wikipage.com', 'wikipage', $band);
		$this->assertAttributeContains('mocksingertest_image', 'image', $band);
	}
	
	public function testEditBand() {
		$band = $this->entityManager->getRepository('TroobApiBundle:Band')->findOneByName('Mock Band Test');
		$band->setName('Fake Band Test');
		$band->setHomepage('http://fakebandtest.homepage.com');
		$band->setWikipage('http://fakebandtest.wikipage.com');
		$band->setImage('fakebandtest_image');
		
		$this->entityManager->persist($band);
		$this->entityManager->flush();
		
	}
	
	public function testGetEditedBand() {
		$band = $this->entityManager->getRepository('TroobApiBundle:Band')->findOneByName('Fake Band Test');
		
		$this->assertAttributeContains('Fake Band Test', 'name', $band);
		$this->assertAttributeContains('http://fakebandtest.homepage.com', 'homepage', $band);
		$this->assertAttributeContains('http://fakebandtest.wikipage.com', 'wikipage', $band);
		$this->assertAttributeContains('fakebandtest_image', 'image', $band);
	}
	
	public function testDeleteBand() {
		$band = $this->entityManager->getRepository('TroobApiBundle:Band')->findOneByName('Fake Band Test');
		$this->entityManager->remove($band);
		$this->entityManager->flush();
	}
	
	public function testGetDeletedBand() {
		$band = $this->entityManager->getRepository('TroobApiBundle:Band')->findOneByName('Fake Band Test');
		$this->assertNull($band);
	}
}

?>