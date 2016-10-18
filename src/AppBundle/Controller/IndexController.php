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
            throw new NotFoundHttpException('Page ' . $page . ' does not exist.');
        }

        // Get Entity Manager
        $em = $this->getDoctrine()->getManager();

        // Setting nbPerPage here, but normally we have tu use a parameter and get it: $this->container->getParameter('nb_per_page')
        $nbPerPage = 5;

        // Get Paginator Object
        $listJobs = $em->getRepository('AppBundle:Job')->getJobs($page, $nbPerPage);

        // Count the number of pages
        $nbPages = ceil(count($listJobs) / $nbPerPage);
        // If page does not exist, throw an exception
        if ($page > $nbPages) {
            throw $this->createNotFoundException('Pages ' . $page . ' does not exist.');
        }

        return $this->render('AppBundle:Index:index.html.twig', array(
          'listJobs' => $listJobs,
          'nbPages'  => $nbPages,
          'page'     => $page,
        ));
    }

    public function menuAction($limit)
    {
        $em = $this->getDoctrine()->getManager();

        $listJobs = $em->getRepository('AppBundle:Job')->findBy(
                array(),                      // No criteria
                array('createdAt' => 'desc'), // Order by date
                $limit,                       // Select $limit jobs
                0                             // From the first
            );

        return $this->render('AppBundle:Index:menu.html.twig', array(
          'listJobs' => $listJobs
        ));
    }
}
