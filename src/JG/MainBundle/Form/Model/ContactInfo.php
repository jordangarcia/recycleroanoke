<?php

namespace JG\MainBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ContactInfo
{
    /**
     * @Assert\NotBlank(message="Name cannot be blank")
     */
    protected $name;

    protected $phone;

    /**
     * @Assert\Email(message="Invalid email")
     * @Assert\NotBlank(message="Email cannot be blank")
     */
    protected $email;

    /**
     * @Assert\NotBlank(message="You must supply a short message")
     */
    protected $message;


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}