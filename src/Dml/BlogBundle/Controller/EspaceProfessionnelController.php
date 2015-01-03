<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\Document;
use Dml\BlogBundle\Form\DocumentType;

class EspaceProfessionnelController extends Controller
{
	/**
	 * @Template
	 */
	public function ajouterDocumentAction()
	{
		$document = new Document();

		$form = $this->createForm(new DocumentType, $document);
		$request = $this->get('request');
    	if ($this->getRequest()->isMethod('POST'))
    	{
	        $form->bind($this->getRequest());
	        if ($form->isValid())
	        {
	            $em = $this->getDoctrine()->getManager();

	            $em->persist($document);
	            $em->flush();

	            $this->get('session')->getFlashBag()->add('info', 'Document bien ajouté!');

	            return $this->redirect($this->generateUrl(
	            	"dmlblog_administration",
	            	array("categorie"=>"espace_professionnel")));
        	}
    	}
		return array('form' => $form->createView(), 'categorie' => 'espace_professionnel');
	}

	/**
	 * @Template
	 */
	public function modifierSupprimerDocumentAction()
	{
		$liste_document = $this->getDoctrine()->getRepository("DmlBlogBundle:Document")->findAll();

		return array('liste_document' => $liste_document, 'categorie' => 'espace_professionnel');
	}

	/**
	 * @Template
	 */
	public function modifierDocumentAction(Document $document)
	{
		$form = $this->createForm(new DocumentType, $document);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Document bien modifié !');

				return $this->redirect($this->generateUrl(
	            	"dmlblog_administration",
	            	array("categorie"=>"espace_professionnel")));
			}
		}

		return array('form' => $form->createView(), 'document' => $document, 'categorie' => 'espace_professionnel');
	}

	/**
	 * @Template
	 */
	public function supprimerDocumentAction(Document $document)
	{
		$form = $this->createFormBuilder()->getForm();

		$request = $this->getRequest();
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
			if ($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->remove($document);
				$em->flush();

				$this->get('session')->getFlashBag()->add('info', 'Le document a bien été supprimé');

				return $this->redirect($this->generateUrl(
	            	"dmlblog_administration",
	            	array("categorie"=>"espace_professionnel")));
			}
		}

		return array('form' => $form->createView(), 'document' => $document, 'categorie' => 'espace_professionnel');
	}
}
