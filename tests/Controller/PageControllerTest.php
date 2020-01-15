<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function testAbout()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');

        $this->assertEquals(1, $crawler->filter('h1:contains("About symblog")')->count());
    }

    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('article.blog')->count() > 0);

        $blogLink = $crawler->filter('article.blog h2 a')->first();
        $blogTitle = $blogLink->text();
        $crawler = $client->click($blogLink->link());
        $this->assertEquals(1, $crawler->filter('h2:contains("'.$blogTitle.'")')->count());
    }

    public function testContact()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $this->assertEquals(1, $crawler->filter('section.main-col h1:contains("Contact symblog")')->count());

        $form = $crawler->selectButton('Submit')->form();

        $form['enquiry_form[name]'] = 'name';
        $form['enquiry_form[email]'] = 'email@email.com';
        $form['enquiry_form[topic]'] = 'topic';
        $form['enquiry_form[message]'] = 'The comment body must be at least 50 characters long as there is a validation constrain on the Enquiry entity';

        $client->submit($form);

        $this->assertResponseRedirects('/contact', 302);

        $this->assertEmailCount(1);
        $email = $this->getMailerMessage(0);
        $this->assertEmailHasHeader($email, 'From', 'name');
    }

}