<?php

namespace App\Controller;

use App\Entity\Enquiry;
use App\Form\EnquiryFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
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
    public function contact(Request $request, MailerInterface $mailer, Session $session)
    {
        $enquiry = new Enquiry();

        $form = $this->createForm(EnquiryFormType::class, $enquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // refactor this block to emailService
            $email = (new TemplatedEmail())
                ->from('enquiries@symblog.co.uk')
                ->to($this->getParameter('app.admin_email'))
                ->subject('Contact enquiry from symblog')
                ->textTemplate('page/_contactEmail.txt.twig')
                ->context(['enquiry' => $enquiry]);

            $mailer->send($email);

            $session->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully send!');

            return $this->redirectToRoute('contact_page');
        }

        return $this->render('page/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
