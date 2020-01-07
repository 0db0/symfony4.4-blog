<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('page/index.html.twig');
    }

    /**
     * @Route("/about", name="about_page", methods={"GET"})
     */
    public function about()
    {
        return $this->render('page/about.html.twig');
    }
}
