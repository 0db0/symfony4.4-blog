<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/{id}", name="show_page", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Blog $blog) //todo: use Blog $blog via ParamConverter instead of int $id. Done!
    {
        if (!$blog) {
            throw $this->createNotFoundException('Ooops! Unable to find blog post');
        }

        $repo = $this->getDoctrine()->getManager()->getRepository(Comment::class);

        $comment = $repo->findNewestCommentForBlog($blog->getId());

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'comment' => $comment
        ]);
    }
}