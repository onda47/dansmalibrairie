<?php
namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
* NewsletterRepository
*/
class NewsletterRepository extends EntityRepository
{
	public function getNewsletters($nombreParPage, $page)
	{
		if ((int) $page < 1) {
			throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
		}
		$query = $this->createQueryBuilder('n')
                  ->orderBy('n.datePublication', 'DESC')
                  ->getQuery();

	    $query->setFirstResult(($page-1) * $nombreParPage)
	          ->setMaxResults($nombreParPage);

	    return new Paginator($query);
	}
}