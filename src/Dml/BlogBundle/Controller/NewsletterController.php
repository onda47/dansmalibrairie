<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\Newsletter;
use Dml\BlogBundle\Form\NewsletterType;

class NewsletterController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterAction()
	{
		$newsletter = new Newsletter();

		$form = $this->createForm(new NewsletterType, $newsletter);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($newsletter);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'La newsletter a bien ajouté !');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => 'newsletter')));
			}
		}
		return array('form' => $form->createView(), 'categorie' => 'newsletter');
	}

	/**
	 * @Template
	 */
	public function modifierAction(Newsletter $newsletter)
	{
		$form = $this->createForm(new NewsletterType, $newsletter);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($newsletter);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'La newsletter a bien été modifié !');

				return $this->redirect($this->
					generateUrl("dmlblog_modifier_supprimer_newsletter", array('categorie' => 'newsletter')));
			}
		}
		return array('form' => $form->createView(), 'newsletter' => $newsletter, 'categorie' => 'newsletter');
	}

	/**
	 * @Template()
	 */
	public function supprimerAction(Newsletter $newsletter)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($newsletter);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'La newsletter a bien été supprimé');

				return $this->redirect($this->generateUrl(
					"dmlblog_administration",
					array('categorie' => 'newsletter')));
			}
		}

		return array('form' => $form->createView(), 'newsletter' => $newsletter, 'categorie' => 'newsletter');
	}

	/**
	 * @Template()
	 */
	public function modifierSupprimerAction()
	{
		$newsletters = $this->getDoctrine()
			->getRepository('DmlBlogBundle:Newsletter')->findAll();

		return array('newsletters' => $newsletters, 'categorie' => 'newsletter');
	}
}
