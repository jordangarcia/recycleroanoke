<?php

namespace JG\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JG\MainBundle\Form\ContactType;
use JG\MainBundle\Form\Model\ContactInfo;


class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $contactInfo = new ContactInfo();
        $form = $this->createForm(new ContactType(), $contactInfo);
        $emailSent = false;
        $failedSubmit = false;

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $this->sendContactEmail($contactInfo);
                $this->addFlash('Your message has been sent!', 'success');
                $emailSent = true;
            } else {
                $this->addFlash('There was a problem sending your message, see below', 'danger');
                $failedSubmit = true;
            }
        }

        return array(
            'form' => $form->createView(),
            'emailSent' => $emailSent,
            'failedSubmit' => $failedSubmit,
        );
    }

    private function sendContactEmail(ContactInfo $contactInfo)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('New message from: '.$contactInfo->getName())
            ->setFrom('recycleroanoke@gmail.com')
            ->setTo('starcityrecycling@gmail.com')
            ->setBody(
                $this->renderView(
                    'MainBundle:Main:contact_email.html.twig',
                    array('info' => $contactInfo)
                ),
                'text/html'
            )
            ->addPart(
                $this->renderView(
                    'MainBundle:Main:contact_email.txt.twig',
                    array('info' => $contactInfo)
                ),
                'text/plain'
            )
        ;

        //echo print_r($message->getBody(), true); die;
        $this->get('mailer')->send($message);

    }

    protected function addFlash($message, $type = 'notice')
    {
        $this->getRequest()->getSession()->getFlashBag()->add($type, $message);
    }
}
