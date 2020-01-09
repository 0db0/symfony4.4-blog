<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Blog::class, 5, function (Blog $blog) {
            $blog->setTitle($this->faker->sentence());
            $blog->setBlog($this->faker->text());
            $blog->setImage('beach.jpg');
            $blog->setAuthor($this->faker->name());
            $blog->setTags('symfony4 php paradise symblog');
        });

        $manager->flush();
    }

//    public function load(ObjectManager $manager)
//    {
//        $blog = new Blog();
//        $blog->setTitle('A day in paradise - A day with Symfony4');
//        $blog->setBlog('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta');
//        $blog->setImage('beach.jpg');
//        $blog->setAuthor('Dmitriy Budko');
//        $blog->setTags('symfony4 php paradise symblog');
//        $manager->persist($blog);
//
//        $manager->flush();
//    }
}
