<?php

namespace App\Service;

use App\Entity\Enquiry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class EmailService
{
    private $param;

    public function __construct(ParameterBagInterface $param)
    {
        $this->param = $param;
    }

    public function fillWithData(Enquiry $enquiry): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from($this->param->get('app.enquiries_email'))
            ->to($this->param->get('app.admin_email'))
            ->subject('Contact enquiry from symblog')
            ->textTemplate('page/_contactEmail.txt.twig')
            ->context(['enquiry' => $enquiry]);

        return $email;
    }
}