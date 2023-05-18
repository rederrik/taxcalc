<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PurchaseControllerTest extends WebTestCase
{
    public function testShowForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/purchase');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Purchase a product');
        $this->assertCount(1, $crawler->filter('form'));
    }

    public function testSuccessfulFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/purchase');

        $form = $crawler->selectButton('Purchase')->form();

        $form['product_purchase[product]']->select('Headphones (100 EUR)');
        $form['product_purchase[taxNumber]'] = 'GR123456789';

        $client->submit($form);

        $this->assertSelectorTextContains('h1', 'Thank you for your purchase!');
        $this->assertSelectorTextContains('#finalprice', '124 EUR');
    }

    public function testFormSubmissionWithInvalidTaxNumber()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/purchase');

        $form = $crawler->selectButton('Purchase')->form();

        $form['product_purchase[product]']->select('Headphones (100 EUR)');
        $form['product_purchase[taxNumber]'] = 'invalid_tax_number';

        $client->submit($form);

        $this->assertFalse($client->getResponse()->isRedirect());

        $this->assertSelectorTextContains('html', 'The tax number is not valid. It should start with 2 letters followed by 9 to 11 digits.');
    }

    public function testFormSubmissionWithMissingTaxNumber()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/purchase');

        $form = $crawler->selectButton('Purchase')->form();

        $form['product_purchase[product]']->select('Headphones (100 EUR)');

        $client->submit($form);

        $this->assertFalse($client->getResponse()->isRedirect());

        $this->assertSelectorTextContains('html', 'Please enter your tax number.');
    }
}
