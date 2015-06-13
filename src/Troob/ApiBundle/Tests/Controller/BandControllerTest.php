<?php

namespace Troob\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BandControllerTest extends WebTestCase
{
    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/band/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /band/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'troob_apibundle_band[name]'  => 'Fake Band Test',
            'troob_apibundle_band[homepage]'  => 'http://fakebandtest.homepage.com',
            'troob_apibundle_band[wikipage]'  => 'http://fakebandtest.wikipage.com',
            'troob_apibundle_band[image]'  => 'fakebandtest_image',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Fake Band Test")')->count(), 'Missing element td:contains("Mano Solo")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("http://fakebandtest.homepage.com")')->count(), 'Missing element td:contains("http://fakebandtest.homepage.com")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("http://fakebandtest.wikipage.com")')->count(), 'Missing element td:contains("http://fakebandtest.wikipage.com")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("fakebandtest_image")')->count(), 'Missing element td:contains("fakebandtest_image")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'troob_apibundle_band[name]'  => 'Mock Singer Test',
            'troob_apibundle_band[homepage]'  => 'http://mocksingertest.homepage.com',
            'troob_apibundle_band[wikipage]'  => 'http://mocksingertest.wikipage.com',
            'troob_apibundle_band[image]'  => 'mocksingertest_image',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Mock Singer Test"]')->count(), 'Missing element [value="Mano Negra"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Mano Negra/', $client->getResponse()->getContent());
    }
}
