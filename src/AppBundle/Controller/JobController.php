<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * @Route("/{id}", name="job_view", requirements={"id" = "\d+"})
     */
    public function viewAction($id)
    {
        // Fake data
        $job = array(
          'title'   => 'symfony2 developer',
          'id'      => $id,
          'author'  => 'Fabien',
          'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem',
          'date'    => new \Datetime()
        );

        return $this->render('AppBundle:Job:view.html.twig', array(
          'job' => $job
        ));
    }

    /**
     * @Route("/new", name="job_new")
     */
    public function newAction(Request $request)
    {
        // If POST request, that means that the user submitted the form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Job has been saved.');

        return $this->redirectToRoute('job_view', array('id' => 5));
        }
        // If not POST, display the form
        return $this->render('AppBundle:Job:new.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="job_edit", requirements={"id" = "\d+"})
     */
    public function editAction($id, Request $request)
    {
        if ($request->isMethod('POST')) {
          $request->getSession()->getFlashBag()->add('notice', 'Job edited.');
          return $this->redirectToRoute('job_view', array('id' => 5));
        }

        // Fake data
        $job = array(
          'title'   => 'Symfony developer',
          'id'      => $id,
          'author'  => 'Hilary',
          'content' => 'fsf f fsd ff fd sdsfd dsf d f',
          'date'    => new \Datetime()
        );

        return $this->render('AppBundle:Job:edit.html.twig', array(
          'job' => $job
        ));
    }

    /**
     * @Route("/delete/{id}", name="job_delete", requirements={"id" = "\d+"})
     */
    public function deleteAction($id)
    {
    }
}
