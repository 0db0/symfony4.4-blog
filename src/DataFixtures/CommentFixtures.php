<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends BaseFixtures
{

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, 10, function (Comment $comment) {
            $comment->setUser($this->faker->name());
            $comment->setComment($this->faker->sentence());
            $comment->setBlog($this->getReference(Blog::class.'_'.rand(0, 4)));
        });

        $manager->flush();
    }
}