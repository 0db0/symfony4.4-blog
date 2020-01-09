<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Enquiry
{
    /**
     * @Assert\NotBlank(message="Please, introduce yourself")
     */
    private $name;

    /**
     * @Assert\Email(message="This email is invalid. Please, type correct email")
     */
    private $email;

    /**
     * @Assert\Length(max="50", maxMessage="To long! Topic must be less than 50 char")
     */
    private $topic;

    /**
     * @Assert\Length(min="50", max="300")
     */
    private $message;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
