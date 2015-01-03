<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\Image;
use Dml\BlogBundle\Form\ImageType;
use Dml\BlogBundle\Entity\Evenement;
use Dml\BlogBundle\Form\EvenementType;
use Dml\BlogBundle\Form\EvenementModifierType;

class EvenementController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterAction($categorie)
	{
		$evenement = new Evenement();
		$evenement->setCategorie($categorie);
		$form = $this->createForm(new EvenementType, $evenement);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$evenement->setAuteur($this->getUser()->getUserName());
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($evenement);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'L\'évènement a bien ajouté !');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => $categorie)));
			}
		}
		return array('form' => $form->createView(), 'categorie' => $categorie);
	}

	/**
	 * @Template
	 */
	public function modifierAction($categorie, Evenement $evenement)
	{
		$form = $this->createForm(new EvenementModifierType, $evenement);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($evenement);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'L\'évènement a bien été modifié !');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => $categorie)));
			}
		}
		return array('form' => $form->createView(), 'categorie' => $categorie, 'evenement' => $evenement);
	}

	/**
	 * @Template()
	 */
	public function supprimerAction(Evenement $evenement, $categorie)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($evenement);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'L\'évènement a bien été supprimé');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => $categorie)));
			}
		}

		return array('form' => $form->createView(), 'evenement' => $evenement, 'categorie' => $categorie);
	}

	/**
	 * @Template()
	 */
	public function modifierSupprimerAction($categorie)
	{
		$liste_evenement = $this->getDoctrine()
			->getRepository('DmlBlogBundle:Evenement')
			->findby(array('categorie' => $categorie), array('dateDebut' => 'desc'));

		return array('liste_evenement' => $liste_evenement, 'categorie' => $categorie);
	}
}
