<?php

namespace AppBundle\Purger;

use Doctrine\ORM\EntityManager;

class JobPurger
{
    /**
    * @var EntityManager
    */
    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function purge($days)
    {
        // Date, $days ago
        $date = new \Datetime($days.' days ago');

        // Get the Jobs we have to delete
        $listJobs = $this->em->getRepository('AppBundle:Job')->getJobsBefore($date);

        foreach ($listJobs as $job) {
            // Get the skills linked to this job
            $jobSkills = $this->em->getRepository('AppBundle:JobSkill')->findBy(array('job' => $job));

            // Delete jobSkill first
            foreach ($jobSkills as $jobSkill) {
                $this->em->remove($jobSkill);
            }
            // Now we can remove Jobs
            $this->em->remove($job);
        }

        $this->em->flush();
    }
}