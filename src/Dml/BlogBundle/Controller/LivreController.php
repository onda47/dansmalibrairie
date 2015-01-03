<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dml\BlogBundle\Entity\Image;
use Dml\BlogBundle\Form\ImageType;
use Dml\BlogBundle\Entity\Livre;
use Dml\BlogBundle\Form\LivreType;
use Dml\BlogBundle\Form\LivreModifierType;

class LivreController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterAction($fonction, $categorie)
	{
		$livre = new Livre();
		$livre->setCategorie($categorie);
		$livre->setFonction($fonction);

		$form = $this->createForm(new LivreType, $livre);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$livre->setAuteurArticle($this->getUser()->getUserName());
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($livre);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'Le livre a bien ajouté !');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array("categorie" => $categorie)));
			}
		}
		return array('form' => $form->createView(), 'fonction' => $fonction, 'categorie' => $categorie);
	}

	/**
	 * @Template
	 */
	public function modifierAction($fonction, $categorie, Livre $livre)
	{
		$form = $this->createForm(new LivreModifierType, $livre);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($livre);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'Le livre a bien été modifié !');

				return $this->redirect(
					$this
					->generateUrl(
						"dmlblog_modifier_supprimer_livre",
						array("categorie" => $categorie, 'fonction' => $fonction)
						)
					);
			}
		}
		return array('form' => $form->createView(),'fonction' => $fonction, 'categorie' => $categorie, 'livre' => $livre);
	}

	/**
	 * @Template()
	 */
	public function supprimerAction(Livre $livre, $categorie, $fonction)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($livre);
				$em->flush();

				$this->container->get('dml_blog.feed')->majRss();

				$this->get('session')->getFlashBag()->add('info', 'Le livre a bien été supprimé');

				return $this->redirect($this->generateUrl("dmlblog_administration", array('categorie' => $categorie)));
			}
		}

		return array('form' => $form->createView(), 'livre' => $livre, 'categorie' => $categorie, 'fonction' => $fonction);
	}

	/**
	 * @Template()
	 */
	public function modifierSupprimerAction($categorie, $fonction)
	{
		$livres = $this->getDoctrine()
		->getRepository('DmlBlogBundle:Livre')
		->findBy(array("categorie" => $categorie, "fonction" => $fonction), array("datePublicationArticle" => 'asc'));

		return array('livres' => $livres, 'categorie' => $categorie, 'fonction' => $fonction);
	}
}
