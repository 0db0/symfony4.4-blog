<?php

namespace App\Tests\Entity;

use App\Entity\Blog;
use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{
    public function testSlugify()
    {
        $blog = new Blog();

        $this->assertEquals('hello-world', $blog->slugify('Hello World'));
        $this->assertEquals('a-day-with-symfony2', $blog->slugify('A Day With Symfony2'));
        $this->assertEquals('hello-world', $blog->slugify('Hello world'));
        $this->assertEquals('symblog', $blog->slugify('symblog '));
        $this->assertEquals('symblog', $blog->slugify(' symblog'));
        $this->assertSame('n-a', $blog->slugify(''));
    }

    public function testSetSlug()
    {
        $blog = new Blog();
        $blog->setSlug('Example Page');

        $this->assertEquals('example-page', $blog->getSlug());
    }

    public function testSetTitle()
    {
        $blog = new Blog();
        $blog->setTitle('Example page ');

        $this->assertEquals('example-page', $blog->getSlug());
    }
}