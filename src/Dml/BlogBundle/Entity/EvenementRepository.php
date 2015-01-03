<?php
namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
* EvenementRepository
*/
class EvenementRepository extends EntityRepository
{
	public function getEvenements($nombreParPage, $page, $categorie)
	{
		if ((int) $page < 1) {
			throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
		}
		$query = $this->createQueryBuilder('e')
                  ->where('e.categorie = :categorie')
                  ->orderBy('e.datePublication', 'DESC')
                  ->getQuery();

	    $query->setParameter('categorie', $categorie);

	    $query->setFirstResult(($page-1) * $nombreParPage)
	          ->setMaxResults($nombreParPage);

	    return new Paginator($query);
	}

	public function getLast($categorie)
	{
		$query = $this->createQueryBuilder('e')
			->where('e.categorie = :categorie')
            ->orderBy('e.datePublication', 'DESC')
            ->setMaxResults(2)
            ->getQuery();
        $query->setParameter('categorie', $categorie);

        return $query->getResult();
	}
}
