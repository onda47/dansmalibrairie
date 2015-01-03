<?php

namespace Dml\BlogBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * CategorieProduitRepository
 */
class CategorieProduitRepository extends EntityRepository
{
	public function findCategories()
	{
		return $this->_em->createQuery('SELECT c.slug, c.nom FROM DmlBlogBundle:CategorieProduit c')->getResult();
	}
}
