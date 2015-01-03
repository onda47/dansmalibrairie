<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Form\FichierSonType;
use Dml\BlogBundle\Entity\FichierSon;
use Dml\BlogBundle\Entity\Emission;
use Dml\BlogBundle\Form\EmissionType;
use Dml\BlogBundle\Form\EmissionModifierType;

class EmissionController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterAction()
	{
		$emission = new Emission();

		$form = $this->createForm(new EmissionType(), $emission);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$emission->setAuteur($this->getUser()->getUserName());
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($emission);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', "L'emission bien ajouté !");

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => 'emission')));
			}
		}
		return array('form' => $form->createView(), 'categorie' => 'emission');
	}

	/**
	 * @Template
	 */
	public function modifierAction(Emission $emission)
	{
		$form = $this->createForm(new EmissionModifierType(), $emission);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($emission);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', "L'émission a bien été modifié !");

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => 'emission')));
			}
		}
		return array(
			'form' => $form->createView(),
			'emission' => $emission,
			'categorie' => 'emission');
	}

	/**
	 * @Template()
	 */
	public function supprimerAction(Emission $emission)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($emission);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', "L'émission a bien été supprimé");

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => 'emission')));
			}
		}

		return array(
			'form' => $form->createView(),
			'emission' => $emission,
			'categorie' => 'emission');
	}

	/**
	 * @Template()
	 */
	public function modifierSupprimerAction()
	{
		$liste_emission = $this->getDoctrine()
			->getRepository('DmlBlogBundle:Emission')
			->findby(array(), array('dateEmission' => 'desc'));

		return array('liste_emission' => $liste_emission, 'categorie' => 'emission');
	}
}
