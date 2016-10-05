<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Job;

class LoadJob extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $jobs = array(
            array(
                'Looking for Symfony developer',
                'Richard',
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempo.',
                ),
            array(
                'Webmaster mission',
                'Michael',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse.',
                ),
            array(
                'Intern webdesigner',
                'Joe',
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem'
                ),
            array(
                'Test Test',
                'Fabien',
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem'
                ),
            );

        foreach ($jobs as $jobArray) {
            $job = new Job();
            $job->setTitle($jobArray[0])
                ->setAuthor($jobArray[1])
                ->setContent($jobArray[2]);
            
            $manager->persist($job);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}