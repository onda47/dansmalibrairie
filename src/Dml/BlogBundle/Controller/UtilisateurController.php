<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\UserBundle\Entity\User;
use Dml\BlogBundle\Form\UtilisateurType;

class UtilisateurController extends Controller
{
	/**
	 * @Template
	 */
	public function modifierSupprimerAction()
	{
		$liste_utilisateur = $this->getDoctrine()
			->getRepository("DmlUserBundle:User")->findAll();
	    return array('liste_utilisateur' => $liste_utilisateur, 'categorie' => 'utilisateur');
	}

	/**
	 * @Template()
	 */
	public function modifierAction(User $user)
	{
		$form = $this->createForm(new UtilisateurType);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($user);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'utilisateur a bien été modifié !");

				return $this->redirect($this->generateUrl("dmlblog_modifier_supprimer_utilisateur"));
			}
		}
		return array('form' => $form->createView(), 'user' => $user, 'categorie' => 'utilisateur');
	}
}
