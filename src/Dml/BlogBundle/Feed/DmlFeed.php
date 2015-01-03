<?php

namespace Dml\BlogBundle\Feed;  

use Dml\BlogBundle\Entity\Emission;
use Dml\BlogBundle\Entity\Livre;
use Dml\BlogBundle\Entity\Evenement;

class DmlFeed
{
    protected $doctrine;
    protected $template;

    public function __construct(\Doctrine\ORM\EntityManager $doctrine, $t) {
        $this->doctrine = $doctrine;
        $this->template = $t;
    }

    public function majRss() {
        $d = $this->doctrine;
        $repo = $d->getRepository('DmlBlogBundle:Livre');

        $n_bd = $repo->getLast('nouveaute', 'bd');
        foreach ($n_bd as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }
        
        $n_jeunesse = $repo->getLast('nouveaute', 'jeunesse');
        foreach ($n_jeunesse as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }

        $cdc_bd = $repo->getLast('coup-de-coeur', 'bd');
        foreach ($cdc_bd as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }
        
        $cdc_jeunesse = $repo->getLast('coup-de-coeur', 'jeunesse');
        foreach ($cdc_jeunesse as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }
        
        $repo = $d->getRepository('DmlBlogBundle:Evenement');

        $evenement_bd = $repo->getLast('bd');
        foreach ($evenement_bd as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }
        $evenement_jeunesse = $repo->getLast('jeunesse');
        foreach ($evenement_jeunesse as $var) {
            $tailles[$var->getImage()->getNomFichier()] = filesize($var->getImage()->getAbsoluteChemin());
        }
        
        $repo = $d->getRepository('DmlBlogBundle:Emission');
        $emission = $repo->getLast();
        foreach ($emission as $var) {
            $tailles[$var->getFichierSon()->getNomFichier()] = filesize($var->getFichierSon()->getAbsoluteChemin());
        }

        // $tailles['logo'] = filesize(__DIR__.'/../../../../web/bundles/blog')
        $rendu = $this->template->renderResponse('DmlBlogBundle:Blog:feed.xml.twig', array(
            'n_bd' => $n_bd,
            'n_jeunesse' => $n_jeunesse,
            'cdc_bd' => $cdc_bd,
            'cdc_jeunesse' => $cdc_jeunesse,
            'evenement_jeunesse' => $evenement_jeunesse,
            'evenement_bd' => $evenement_bd,
            'emissions' => $emission,
            'tailles' => $tailles
        ));

        $fic = fopen(__DIR__.'/../../../../web/feed.rss', 'w');
        ftruncate($fic, 0);
        fputs($fic, $rendu->getContent());
        fclose($fic);
    }
}
