<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Form\ImageType;
use Dml\BlogBundle\Entity\Image;
use Dml\BlogBundle\Entity\Gallerie;
use Dml\BlogBundle\Form\GallerieType;
use Dml\BlogBundle\Form\GallerieModifierType;

class GallerieController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterAction()
	{
		$gallerie = new Gallerie();

		$form = $this->createForm(new GallerieType(), $gallerie);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($gallerie);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'image a bien été ajouté à la gallerie !");

				return $this->redirect($this->
					generateUrl("dmlblog_gallerie"));
			}
		}
		return array('form' => $form->createView());
	}

	/**
	 * @Template
	 */
	public function modifierAction(Gallerie $gallerie)
	{
		$form = $this->createForm(new GallerieModifierType(), $gallerie);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($gallerie);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'image a bien été modifié !");

				return $this->redirect($this->
					generateUrl("dmlblog_gallerie"));
			}
		}
		return array(
			'form' => $form->createView(),
			'gallerie' => $gallerie);
	}

	/**
	 * @Template()
	 */
	public function supprimerAction(Gallerie $gallerie)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($gallerie);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'image a bien été supprimé.");

				return $this->redirect($this->
					generateUrl("dmlblog_gallerie"));
			}
		}

		return array(
			'form' => $form->createView(),
			'gallerie' => $gallerie);
	}
}
