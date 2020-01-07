<?php

namespace App\Controller;

use App\Entity\Enquiry;
use App\Form\EnquiryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
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

    /**
     * @Route("/contact", name="contact_page", methods={"GET", "POST"})
     */
    public function contact(Request $request)
    {
        $enquiry = new Enquiry();

        $form = $this->createForm(EnquiryFormType::class, $enquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('contact_page');
        }

        return $this->render('page/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
