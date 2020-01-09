<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/{id}", name="show_page", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(int $id) //todo: use Blog $blog via ParamConverter instead of int $id
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository(Blog::class)->findOneBy(['id' => $id]);

        if (!$blog) {
            throw $this->createNotFoundException('Ooops! Unable to find blog post');
        }

        return $this->render('blog/show.html.twig', [
            'blog' =>$blog
        ]);
    }
}