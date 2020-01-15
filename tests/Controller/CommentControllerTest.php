<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
//    todo: using Mock for clear testing
    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/19/minus-necessitatibus-voluptatem-laborum-facilis-necessitatibus');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Submit')->form([
            'comment[user]' => 'name',
            'comment[comment]' => 'comment'
        ]);

        $client->submit($form);

        $crawler = $client->followRedirect();

        $articleCrawler = $crawler->filter('section .previous-comments article')->first();

        $this->assertEquals('name', $articleCrawler->filter('header span.highlight')->text());
        $this->assertEquals('comment', $articleCrawler->filter('p')->last()->text());

        // Check the sidebar to ensure latest comments are display and there is 10 of them

        $this->assertEquals(5, $crawler->filter('aside.sidebar section')->last()
            ->filter('article')->count()
        );

        $this->assertEquals('name', $crawler->filter('aside.sidebar section')->last()
            ->filter('article')->first()
            ->filter('header span.highlight')->text()
        );
    }
}