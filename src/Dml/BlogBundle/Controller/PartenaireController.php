<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\CategoriePartenaire;
use Dml\BlogBundle\Form\CategoriePartenaireType;
use Dml\BlogBundle\Entity\Partenaire;
use Dml\BlogBundle\Form\PartenaireType;

class PartenaireController extends Controller
{
	/****************************************
	 * PARTENAIRE
	 ****************************************/
	/**
	 * @Template
	 */
	public function ajouterPartenaireAction()
	{
		$partenaire = new Partenaire();

		$form = $this->createForm(new PartenaireType, $partenaire);
		$request = $this->get('request');
		if($request->getMethod() == 'POST')
		{
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($partenaire);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Le partenaire a bien été ajouté !');

                return $this->redirect($this->
                	generateUrl('dmlblog_administration', array('categorie' => 'partenaire')));
            }
		}

		return array('form' => $form->createView(), 'categorie' => 'partenaire');
	}

	/**
	 * @Template
	 */
	public function modifierSupprimerPartenaireAction()
	{
		$liste_categorie_partenaire = $this->getDoctrine()->getRepository("DmlBlogBundle:CategoriePartenaire")->findAll();

		return array(
			'liste_categorie_partenaire' => $liste_categorie_partenaire,
			'categorie' => 'partenaire');
	}

	/**
	 * @Template
	 */
	public function modifierPartenaireAction(Partenaire $partenaire)
	{
		$form = $this->createForm(new PartenaireType(), $partenaire);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Partenaire bien modifié !');

				return $this->redirect($this->
					generateUrl("dmlblog_administration", array('categorie' => 'partenaire')));
			}
		}

		return array(
			'form' => $form->createView(),
			'partenaire' => $partenaire,
			'categorie' => 'partenaire');
	}

	/**
	 * @Template
	 */
	public function supprimerPartenaireAction(Partenaire $partenaire)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($partenaire);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Le partenaire a bien été supprimé');

				return $this->redirect($this->
					generateUrl(
						"dmlblog_administration",
						array('categorie' => 'partenaire')));
			}
		}

		return array(
			"form" => $form->createView(),
			'partenaire' => $partenaire,
			'categorie' => 'partenaire');
	}

	/****************************************
	 * CATEGORIE PARTENAIRE
	 ****************************************/

	/**
	 * @Template
	 */
	public function ajouterCategoriePartenaireAction()
	{
		$categoriePartenaire = new CategoriePartenaire();

		$form = $this->createForm(new CategoriePartenaireType(), $categoriePartenaire);
		$request = $this->get('request');
		if($request->getMethod() == 'POST')
		{
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categoriePartenaire);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La catégorie de partenaire a bien été ajouté !');

                return $this->redirect($this->
                	generateUrl('dmlblog_administration', array('categorie' => 'partenaire')));
            }
		}

		return array('form' => $form->createView(), 'categorie' => 'partenaire');
	}

	/**
	 * @Template()
	 */
	public function modifierSupprimerCategoriePartenaireAction()
	{
	    $em = $this->getDoctrine()->getManager();
	    $liste_categorie_partenaire = $em->getRepository('DmlBlogBundle:CategoriePartenaire')->findAll();

	    return array(
	    	'liste_categorie_partenaire' => $liste_categorie_partenaire,
	    	'categorie' => 'partenaire');
	}

	/**
	 * @Template()
	 */
	public function modifierCategoriePartenaireAction(CategoriePartenaire $categoriePartenaire)
	{
		$form = $this->createForm(new CategoriePartenaireType(), $categoriePartenaire);
		$request = $this->get('request');
		if($request->getMethod() == 'POST')
		{
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categoriePartenaire);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La catégorie de partenaire à bien été modifié');

                return $this->redirect($this->
                	generateUrl('dmlblog_administration', array('categorie' => 'partenaire')));
            }
		}

		return array(
			'form' => $form->createView(),
			'categoriePartenaire' => $categoriePartenaire,
			'categorie' => 'partenaire');
	}

	/**
	 * @Template()
	 */
	public function supprimerCategoriePartenaireAction(CategoriePartenaire $categoriePartenaire)
	{

		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$liste_partenaire_associe = $em->getRepository('DmlBlogBundle:Partenaire')->findByCategoriePartenaire($categoriePartenaire->getId());
				foreach ($liste_partenaire_associe as $partenaire)
				{
					$em->remove($partenaire);
				}
				$em->remove($categoriePartenaire);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'La catégorie de partenaire a bien été supprimé');

				return $this->redirect($this->generateUrl(
					"dmlblog_administration",
					array('categorie' => 'partenaire')));
			}
		}

		return array(
			'form' => $form->createView(),
			'categoriePartenaire' => $categoriePartenaire,
			'categorie' => 'partenaire');
	}

	/**
	 * @Template()
	 */
	public function definirOrdreAction()
	{

	}
}
