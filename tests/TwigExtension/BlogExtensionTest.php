<?php

namespace App\Tests\TwigExtension;

use App\TwigExtension\BlogExtension;
use PHPUnit\Framework\TestCase;

class BlogExtensionTest extends TestCase
{
    public function testCreatedAgo()
    {
        $blogExtension = new BlogExtension();

        $this->assertEquals('0 seconds ago', $blogExtension->createdAgo(new \DateTime()));
        $this->assertEquals('34 seconds ago', $blogExtension->createdAgo($this->getDateTime(-34)));
        $this->assertEquals('1 minute ago', $blogExtension->createdAgo($this->getDateTime(-60)));
        $this->assertEquals('2 minutes ago', $blogExtension->createdAgo($this->getDateTime(-120)));
        $this->assertEquals('1 hour ago', $blogExtension->createdAgo($this->getDateTime(-3600)));
        $this->assertEquals('1 hour ago', $blogExtension->createdAgo($this->getDateTime(-3601)));
        $this->assertEquals('2 hours ago', $blogExtension->createdAgo($this->getDateTime(-7200)));

        $this->expectException('\InvalidArgumentException');
        $blogExtension->createdAgo($this->getDateTime(60));
    }

    protected function getDateTime($delta)
    {
        return new \DateTime(date('Y-m-d H:i:s', time()+$delta));
    }
}