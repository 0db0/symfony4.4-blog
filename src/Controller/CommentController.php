<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    public function newComment(Blog $blog)
    {
        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(CommentType::class, $comment);

        return $this->render('comment/form.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{id}", name="create_comment_page", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function create(Blog $blog, Request $request)
    {
        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->saveComment($comment);

            return $this->redirectToRoute('show_page', [
                'id' => $blog->getId(),
                'slug' => $blog->getSlug()
            ]).'#comment-' . $comment->getId();
        }

        return $this->render('comment/create.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    private function saveComment(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
    }
}