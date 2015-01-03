<?php
namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
* CategoriePartenaireRepository
*/
class CategoriePartenaireRepository extends EntityRepository
{
	public function orderBy1()
	{
		$qb = $this->createQueryBuilder('c');

		$qb ->select('partial c.{id, nom}')
			->join('c.partenaires', 'p')
				->addSelect('partial p.{id, lien, lienAfficher}')
			->orderBy('c.priorite');

		return $qb->getQuery()->getArrayResult();
	}

	public function orderBy()
	{
		$query = $this->_em->createQuery(
		"SELECT c.nom, p.lien, p.lienAfficher 
		FROM DmlBlogBundle:CategoriePartenaire c 
		JOIN c.partenaires p
		ORDER BY c.priorite");
		return $query->getResult();
	}
}