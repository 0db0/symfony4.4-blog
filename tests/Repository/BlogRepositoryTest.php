<?php

namespace App\Tests\Repository;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogRepositoryTest extends WebTestCase
{
    private $blogRepository;

    public function setUp(): void
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->blogRepository = $kernel->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Blog::class);
    }

    public function testGetTags()
    {
        $tags = $this->blogRepository->getTags();

        $this->assertTrue(count($tags) > 1);
        $this->assertContains('symfony4', $tags);
    }

    public function testGetTagWeights()
    {
        $tagWeight = $this->blogRepository->getTagWeights(['php', 'js', 'symfony', 'nginx', 'php']);

        $this->assertTrue(count($tagWeight) > 1);

        $tagWeight = $this->blogRepository->getTagWeights(array_fill(0, 10, 'php'));

        $this->assertTrue(count($tagWeight) >= 1);

        $tagWeight = $this->blogRepository->getTagWeights(
            array_merge(
                array_fill(0, 10, 'php'),
                array_fill(0, 2, 'html'),
                array_fill(0, 6, 'js')
            )
        );

        $this->assertEquals(5, $tagWeight['php']);
        $this->assertEquals(3, $tagWeight['js']);
        $this->assertEquals(1, $tagWeight['html']);

        $tagWeight = $this->blogRepository->getTagWeights(array());

        $this->assertEmpty($tagWeight);
    }
}