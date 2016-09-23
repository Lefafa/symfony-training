<?php

namespace AppBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Email\ApplicationMailer;
use AppBundle\Entity\Application;

class ApplicationCreationListener
{
    /**
     * @var ApplicationMailer
     */
    private $applicationMailer;

    public function __construct(ApplicationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // We wan to send an email only for Application entity
        if (!$entity instanceof Application) {
            return;
        }

        $this->applicationMailer->sendNewNotification($entity);
    }
}

