<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/{id}/{slug}", name="show_page", methods={"GET"}, requirements={"id"="\d+"}, defaults={"comments": true})
     */
    public function show(Blog $blog, $slug, $comments)
    {
        if (!$blog) {
            throw $this->createNotFoundException('Ooops! Unable to find blog post');
        }
//        todo: think about creating CommentService
        $repo = $this->getDoctrine()->getManager()->getRepository(Comment::class);

        $comments = $repo->findNewestCommentForBlog($blog->getId());

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'comments' => $comments
        ]);
    }
}