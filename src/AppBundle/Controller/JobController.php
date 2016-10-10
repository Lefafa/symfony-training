<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Job;
use AppBundle\Entity\Application;
use AppBundle\Form\JobType;

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
        // Get Entity Manager
        $em = $this->getDoctrine()->getManager();

        $job = $em->getRepository('AppBundle:Job')->find($id);

        return $this->render('AppBundle:Job:view.html.twig', array(
          'job' => $job
        ));
    }

    /**
     * @Route("/new", name="job_new")
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);

        // If POST request, that means that the user submitted the form
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Job has been saved.');

            return $this->redirectToRoute('job_view', array('id' => $job->getId()));
        }
        // If not POST, display the form
        return $this->render('AppBundle:Job:new.html.twig', array(
            'form' => $form->createView(),
            ));
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

    /**
     * @Route("/purge/{days}", name="job_purge", requirements={"days" = "\d+"})
     */
    public function purgeAction($days, Request $request)
    {
        // Get the service
        $purger = $this->get('app.purger.job');

        // Purge thhe jobs
        $test = $purger->purge($days);

        // Add a message
        $request->getSession()->getFlashBag()->add(
                'info',
                'Job advertisements older than '.$days.' have been deleted.'
                );

        // Redirect to home page
        return $this->redirectToRoute('index_home');
  }
}
