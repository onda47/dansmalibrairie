<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\Image;
use Dml\BlogBundle\Form\ImageType;
use Dml\BlogBundle\Entity\FichierSon;
use Dml\BlogBundle\Form\FichierSonType;
use Dml\BlogBundle\Entity\Information;
use Dml\BlogBundle\Form\InformationType;

class AdministrationController extends Controller
{
	/**
	 * @Template()
	 */
	public function menuAction($categorie)
	{
		return array('categorie' => $categorie);
	}

	/**
	 * @Template()
	 */
	public function modifierImageAction(Image $image)
	{
	    $form = $this->createForm(new ImageType, $image);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($image);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'image a bien été modifié !");

				return $this->redirect($this->generateUrl("dmlblog_administration", array('categorie' => 'jeunesse')));
			}
		}
		return array('form' => $form->createView(), 'image' => $image, 'categorie' => 'jeunesse');
	}

	/**
	 * @Template()
	 */
	public function modifierFichierSonAction(FichierSon $fichierSon)
	{
	    $form = $this->createForm(new FichierSonType, $fichierSon);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($fichierSon);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "Le fichier son a bien été modifié !");

				return $this->redirect($this->generateUrl("dmlblog_administration", array('categorie' => 'radio_bulle')));
			}
		}
		return array('form' => $form->createView(), 'fichierSon' => $fichierSon, 'categorie' => 'radio_bulle');
	}

	/**
	 * @Template()
	 */
	public function modifierInformationAction(Information $information)
	{
	    $form = $this->createForm(new InformationType, $information);
		$request = $this->get('request');
		if ($this->getRequest()->isMethod('POST'))
		{
			$form->bind($this->getRequest());
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();

				$em->persist($information);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', "L'information a bien été modifié !");

				return $this->redirect($this->generateUrl("dmlblog_administration", array('categorie' => 'information')));
			}
		}
		return array('form' => $form->createView(), 'information' => $information, 'categorie' => 'information');
	}
}
