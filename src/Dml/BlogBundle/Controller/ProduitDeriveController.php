<?php

namespace Dml\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dml\BlogBundle\Entity\CategorieProduit;
use Dml\BlogBundle\Form\CategorieProduitType;
use Dml\BlogBundle\Entity\SousCategorieProduit;
use Dml\BlogBundle\Form\SousCategorieProduitType;
use Dml\BlogBundle\Entity\Produit;
use Dml\BlogBundle\Form\ProduitType;
use Dml\BlogBundle\Form\ProduitModifierType;
use Dml\BlogBundle\Entity\Image;
use Dml\BlogBundle\Form\ImageType;

class ProduitDeriveController extends Controller
{
    /*******************************************
     * CATEGORIE
     *******************************************/

    /**
     * @Template
     */
    public function ajouterCategorieAction()
    {
        $categorieProduit = new CategorieProduit();

        $form = $this->createForm(new CategorieProduitType, $categorieProduit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La catégorie de produit dérivé a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl('dmlblog_administration', array('categorie' => 'produits_derives')));
            }
        }

        return array('form' => $form->createView(), 'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierSupprimerCategorieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeCategorie = $em->getRepository('DmlBlogBundle:CategorieProduit')->findAll();

        return array(
            'liste_categorie_produit' => $listeCategorie,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierCategorieProduitDeriveAction(CategorieProduit $categorieProduit)
    {
        $form = $this->createForm(new CategorieProduitType, $categorieProduit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La catégorie de produit dérivé a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl(
                        'dmlblog_administration',
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'ccategorie' => $categorieProduit,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function supprimerCategorieProduitDeriveAction(CategorieProduit $categorieProduit)
    {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($categorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La catégorie a bien été supprimé');

                return $this->redirect($this->
                    generateUrl(
                        "dmlblog_administration",
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'ccategorie' => $categorieProduit,
            'categorie' => 'produits_derives');
    }

    /*******************************************
     * SOUS CATEGORIE
     *******************************************/

    /**
     * @Template
     */
    public function ajouterSousCategorieAction()
    {
        $sousCategorieProduit = new SousCategorieProduit();

        $form = $this->createForm(new SousCategorieProduitType, $sousCategorieProduit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($sousCategorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La nouvelle sous catégorie a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl(
                        'dmlblog_administration',
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierSupprimerSousCategorieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeSousCategorie = $em->getRepository('DmlBlogBundle:SousCategorieProduit')->findAll();

        return array(
            'liste_sous_categorie_produit' => $listeSousCategorie,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierSousCategorieProduitDeriveAction(SousCategorieProduit $sousCategorieProduit)
    {
        $form = $this->createForm(new SousCategorieProduitType, $sousCategorieProduit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($sousCategorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La sous catégorie '.$sousCategorieProduit->getNom().' a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl(
                        'dmlblog_administration',
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'sous_categorie' => $sousCategorieProduit,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function supprimerSousCategorieProduitDeriveAction(SousCategorieProduit $sousCategorieProduit)
    {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($sousCategorieProduit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'La sous catégorie '.$sousCategorieProduit->getNom().' a bien été supprimé');

                return $this->redirect($this->
                    generateUrl(
                        "dmlblog_administration",
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'sous_categorie' => $sousCategorieProduit,
            'categorie' => 'produits_derives');
    }

    /*******************************************
     * PRODUIT
     *******************************************/

    /**
     * @Template()
     */
    public function ajouterProduitAction()
    {
        $produit = new Produit();

        $form = $this->createForm(new ProduitType(), $produit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Le nouveau produit a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl(
                        'dmlblog_administration',
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierSupprimerProduitAction()
    {
        $em = $this->getDoctrine()->getManager();
        $liste_sous_categorie = $em->getRepository('DmlBlogBundle:SousCategorieProduit')->findAll();

        return array(
            'liste_sous_categorie' => $liste_sous_categorie,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function modifierProduitAction(Produit $produit)
    {
        $form = $this->createForm(new ProduitModifierType(), $produit);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Le produit "'.$produit->getImage()->getAlt().'" a bien été sauvegardé');

                return $this->redirect($this->
                    generateUrl(
                        'dmlblog_administration',
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'produit' => $produit,
            'categorie' => 'produits_derives');
    }

    /**
     * @Template()
     */
    public function supprimerProduitAction(Produit $produit)
    {

        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($produit);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Le produit "'.$produit->getImage()->getAlt().'"" a bien été supprimé');

                return $this->redirect($this->
                    generateUrl(
                        "dmlblog_administration",
                        array('categorie' => 'produits_derives')));
            }
        }

        return array(
            'form' => $form->createView(),
            'produit' => $produit,
            'categorie' => 'produits_derives');
    }
}
