<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * @Route("/{page}", name="index_home", defaults={"page" = 1}, requirements={"page" = "\d+"})
     */
    public function indexAction($page)
    {   
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" does not exist.');
        }

        // Fake data
        $listJobs = array(
            array(
                'title'   => 'Looking for Symfony developer',
                'id'      => 1,
                'author'  => 'Richard',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempo.',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Webmaster mission',
                'id'      => 2,
                'author'  => 'Michael',
                'content' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse.',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Intern webdesigner',
                'id'      => 3,
                'author'  => 'Joe',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem',
                'date'    => new \Datetime())
        );

        // Test the AntiSpam service
        $antispam = $this->container->get('app.antispam');
        dump( $antispam->isSpam('Hello Team, I am a spam.') );

        return $this->render('AppBundle:Index:index.html.twig', array(
          'listJobs' => $listJobs,
        ));
    }

    public function menuAction($limit)
    {
        // Fake data
        $listJobs = array(
          array('id' => 2, 'title' => 'Looking for Symfony developer'),
          array('id' => 5, 'title' => 'Webmaster mission'),
          array('id' => 9, 'title' => 'Intern webdesigner')
        );

        return $this->render('AppBundle:Index:menu.html.twig', array(
          'listJobs' => $listJobs
        ));
    }
}
