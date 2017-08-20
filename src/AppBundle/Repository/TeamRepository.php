<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * TeamRepository
 *
 */
class TeamRepository extends \Doctrine\ORM\EntityRepository
{

    

		
		public function findRechercheTeam($chaine)
		{

			
	$qb= $this->createQueryBuilder('t')
			->orderBy('t.id' , 'asc')
           ->where('t.libelle LIKE :chaine')
           ->andwhere('t.status!=  9')
           ->setParameter('chaine', '%'.$chaine.'%' );


           return $qb->getQuery()
    ->getResult();


		}



	


}
