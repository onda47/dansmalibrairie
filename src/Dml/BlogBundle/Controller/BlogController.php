<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Form\MailType;
use Dml\BlogBundle\Entity\Mail;
use Dml\BlogBundle\Entity\CategorieProduit;
use Dml\BlogBundle\Entity\Emission;
use Dml\BlogBundle\Entity\Livre;
use Dml\BlogBundle\Entity\Evenement;
use Dml\BlogBundle\Entity\Newsletter;

class BlogController extends Controller
{
	/**
	 * @Template()
	 */
	public function bacASableAction()
	{
		$this->container->get('dml_blog.feed')->majRss();

	    $d = $this->getDoctrine();
		$repo = $d->getRepository('DmlBlogBundle:Livre');

		$n_bd = $repo->getLast('nouveaute', 'bd');
		$n_jeunesse = $repo->getLast('nouveaute', 'jeunesse');
		$n_sf = $repo->getLast('nouveaute', 'science-fiction');

		$cdc_bd = $repo->getLast('coup-de-coeur', 'bd');
		$cdc_jeunesse = $repo->getLast('coup-de-coeur', 'jeunesse');
		$cdc_sf = $repo->getLast('coup-de-coeur', 'science-fiction');

		$repo = $d->getRepository('DmlBlogBundle:Evenement');

		$evenement_bd = $repo->getLast('bd');
		$evenement_jeunesse = $repo->getLast('jeunesse');
		$evenement_sf = $repo->getLast('science-fiction');

		$repo = $d->getRepository('DmlBlogBundle:Information');
		$information = $repo->findOneById(1);

		return array(
			'n_bd' => $n_bd,
			'n_jeunesse' => $n_jeunesse,
			'cdc_bd' => $cdc_bd,
			'cdc_jeunesse' => $cdc_jeunesse,
			'evenement_jeunesse' => $evenement_jeunesse,
			'evenement_bd' => $evenement_bd,
			'information' => $information
		);
	}
	/**
	 * @Template
	 */
	public function accueilAction()
	{
		$d = $this->getDoctrine();
		$repo = $d->getRepository('DmlBlogBundle:Livre');

		$n_bd = $repo->getLast('nouveaute', 'bd');
		$n_jeunesse = $repo->getLast('nouveaute', 'jeunesse');
		$n_sf = $repo->getLast('nouveaute', 'science-fiction');

		$cdc_bd = $repo->getLast('coup-de-coeur', 'bd');
		$cdc_jeunesse = $repo->getLast('coup-de-coeur', 'jeunesse');
		$cdc_sf = $repo->getLast('coup-de-coeur', 'science-fiction');

		$repo = $d->getRepository('DmlBlogBundle:Evenement');

		$evenement_bd = $repo->getLast('bd');
		$evenement_jeunesse = $repo->getLast('jeunesse');
		$evenement_sf = $repo->getLast('science-fiction');

		$repo = $d->getRepository('DmlBlogBundle:Information');
		$information = $repo->findOneById(1);

		return array(
			'n_bd' => $n_bd,
			'n_jeunesse' => $n_jeunesse,
			'cdc_bd' => $cdc_bd,
			'cdc_jeunesse' => $cdc_jeunesse,
			'evenement_jeunesse' => $evenement_jeunesse,
			'evenement_bd' => $evenement_bd,
			'information' => $information
		);
	}

	/**
	 * @Template
	 */
	public function navAction($categorie)
	{
		$em = $this->getDoctrine()->getManager();
		$liste_categorie_produit = $em->
			getRepository('DmlBlogBundle:CategorieProduit')
			->findCategories();

		return array('liste_categorie_produit' => $liste_categorie_produit, 'categorie' => $categorie);
	}

    /**
     * @Template
     */
    public function footerAction($categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $liste_categorie_produit = $em->
            getRepository('DmlBlogBundle:CategorieProduit')
            ->findCategories();

        return array('categorie' => $categorie);
    }

	public function librairieAction()
	{
		return $this->render('DmlBlogBundle:Blog:librairie.html.twig');
	}

	/**
	 * @Template()
	 */
	public function librairieArticlePresseAction($titre, $image)
	{
	    return array('image' => $image);
	}

	/**
	 * @Template()
	 */
	public function livreAction($fonction, $categorie, $page)
	{
		$nb_page = $this->container->getParameter('dmlblog.nombre_par_page');

		$livres = $this->getDoctrine()
			->getRepository('DmlBlogBundle:Livre')
			->getLivres($nb_page, $page, $categorie, $fonction);
		return array(
			'nb_page'  => ceil(count($livres) / $nb_page) ?: 1,
			'page' => $page,
			'livres' => $livres,
			'fonction' => $fonction,
			'categorie' => $categorie
			);
	}

	/**
	 * @Template()
	 */
	public function livreUniqueAction($fonction, $categorie, Livre $livre)
	{
		return array(
			'fonction' => $fonction,
			'categorie' => $categorie,
			'livre' => $livre
			);
	}

	/**
	 * @Template()
	 */
	public function evenementAction($categorie, $page)
	{
		$nb_par_page = $this->container->getParameter('dmlblog.nombre_par_page');

		$liste_evenement = $this->getDoctrine()
			->getRepository("DmlBlogBundle:Evenement")
			->getEvenements($nb_par_page, $page, $categorie);

		return array(
			'nb_page' => ceil(count($liste_evenement) / $nb_par_page) ?: 1,
			'page' => $page,
			'liste_evenement' => $liste_evenement,
			'categorie' => $categorie);
	}


	/**
	 * @Template()
	 */
	public function evenementUniqueAction($categorie, Evenement $evenement)
	{
		return array(
			'categorie' => $categorie,
			'evenement' => $evenement
			);
	}


	/**
	 * @Template()
	 */
	public function newsletterAction($page)
	{
		$newsletters = $this->getDoctrine()
			->getRepository('DmlBlogBundle:Newsletter')
			->getNewsletters(1, $page);

		return array(
			'nb_page'  => count($newsletters),
			'page' => $page,
			'newsletters' => $newsletters,
			'categorie' => 'newsletter'
			);
	}

	/**
	 * @Template
	 */
	public function emissionAction()
	{
		$liste_emission = $this->getDoctrine()
			->getRepository("DmlBlogBundle:Emission")->findby(array(), array('dateEmission' => 'desc'), null, null);
	    return array('liste_emission' => $liste_emission, 'categorie' => 'emission');
	}


	/**
	 * @Template
	 */
	public function emissionUniqueAction(Emission $emission)
	{
	    return array('emission' => $emission, 'categorie' => 'emission');
	}

	/**
	 * @Template
	 */
	public function gallerieAction($page)
	{
		$images = $this->getDoctrine()->getRepository("DmlBlogBundle:Gallerie")
			->getGalleries(20, $page);

		return array('galleries' => $images,
			'nb_page'  => ceil(count($images) / 20) ?: 1,
			'page' => $page);
	}

	/**
	 * @Template
	 */
	public function espaceProfessionnelAction()
	{
		$liste_document = $this->getDoctrine()
			->getRepository("DmlBlogBundle:Document")
			->findAll();
        $message_pro = $this->getDoctrine()
            ->getRepository("DmlBlogBundle:MessagePro")
            ->find(1);
		return  array('liste_document' => $liste_document,
            'categorie' => 'espace_professionnel', 
            'message_pro' => $message_pro->getText());
	}

	/**
	 * @Template
	 */
	public function contactAction()
	{
		$mail = new Mail();
        $form = $this->createForm(new MailType, $mail);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $message = \Swift_Message::newInstance()
                    ->setSubject($mail->getSujet())
                    ->setFrom($mail->getCourriel())
                    ->setTo($this->container->getParameter('mailer_user'))
                    ->setBody($mail->getPrenom().' '.$mail->getNom().' vous envoit: '.$mail->getContenu());

                if ($this->get('mailer')->send($message)) {
                	$this->get('session')->getFlashBag()->add('info', 'Votre message a bien été envoyé !');

	                $em = $this->getDoctrine()->getManager();
	                $em->persist($mail);
	                $em->flush();
                } else {
                	$this->get('session')->getFlashBag()->add('info', "Une erreur s'est produite, veuillez envoyer un mail à contact@dansmalibrairie.com pour le signaler.");
                }
                return $this->redirect($this->generateUrl("dmlblog_homepage"));
            }
        }

		return array('form' => $form->createView());
	}

	/**
	 * @Template()
	 */
	public function mentionsLegalesAction()
	{
		return array();
	}

	/**
	 * @Template()
	 */
	public function partenairesAction()
	{
		$donnees = $this->getDoctrine()
			->getRepository('DmlBlogBundle:CategoriePartenaire')
			->orderBy();
		return array('donnees' => $donnees, 'categorie' => 'partenaire');
	}

	/**
	 * @Template()
	 */
	public function produitDeriveAction(CategorieProduit $categorieProduit)
	{
		$em = $this->getDoctrine()->getManager();
		$listeSousCategorie = $em->getRepository('DmlBlogBundle:SousCategorieProduit')->findByCategorieProduit($categorieProduit->getId());

		return array(
			'categorieProduit' => $categorieProduit,
			'liste_sous_categorie' => $listeSousCategorie,
			'categorie' => 'produits_derives');
	}
}
