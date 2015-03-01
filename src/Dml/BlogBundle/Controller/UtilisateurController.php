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
	public function modifierAction($id)
	{
		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('id' => $id));
		$user->addRole('ROLE_PROFESSIONNEL');
		$userManager->updateUser($user);

		$this->get('session')->getFlashBag()->add('info', "L'utilisateur a bien été promu !");

		return $this->redirect($this->
			generateUrl("dmlblog_administration", array("categorie" => "utilisateur")));
	}
}
