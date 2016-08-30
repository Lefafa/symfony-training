<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/advert")
 */
class AdvertController extends Controller
{
    /**
     * @Route("/{id}", name="advert_view", requirements={"id" = "\d+"})
     */
    public function viewAction($id)
    {
        // Fake data
        $advert = array(
          'title'   => 'symfony2 developer',
          'id'      => $id,
          'author'  => 'Fabien',
          'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem',
          'date'    => new \Datetime()
        );

        return $this->render('AppBundle:Advert:view.html.twig', array(
          'advert' => $advert
        ));
    }

    /**
     * @Route("/new", name="advert_new")
     */
    public function newAction(Request $request)
    {
        // If POST request, that means that the user submitted the form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Advert has been saved.');

        return $this->redirectToRoute('advert_view', array('id' => 5));
        }
        // If not POST, display the form
        return $this->render('AppBundle:Advert:new.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="advert_edit", requirements={"id" = "\d+"})
     */
    public function editAction($id, Request $request)
    {
        if ($request->isMethod('POST')) {
          $request->getSession()->getFlashBag()->add('notice', 'Advert edited.');
          return $this->redirectToRoute('advert_view', array('id' => 5));
        }

        // Fake data
        $advert = array(
          'title'   => 'Symfony developer',
          'id'      => $id,
          'author'  => 'Hilary',
          'content' => 'fsf f fsd ff fd sdsfd dsf d f',
          'date'    => new \Datetime()
        );

        return $this->render('AppBundle:Advert:edit.html.twig', array(
          'advert' => $advert
        ));
    }

    /**
     * @Route("/delete/{id}", name="advert_delete", requirements={"id" = "\d+"})
     */
    public function deleteAction($id)
    {
    }
}
