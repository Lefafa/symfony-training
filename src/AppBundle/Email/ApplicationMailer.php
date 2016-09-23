<?php

namespace AppBundle\Email;

use AppBundle\Entity\Application;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Application $application)
    {
        $message = new \Swift_Message(
            'New application',
            'You got a new application.'
            );

        $message
            ->addTo($application->getAdvert()->getAuthor()) // We use the attribute author for the example
            ->addFrom('admin@pouetpouet.com')
            ;

        $this->mailer->send($message);
    }
}

