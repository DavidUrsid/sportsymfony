<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * PanierRepository
 *
 */
class PanierRepository extends \Doctrine\ORM\EntityRepository
{

    

		
		public function findAllStatus2()
		{

			
	$qb= $this->createQueryBuilder('p')			
        
           ->where('p.status= ?2');
        


           return $qb->getQuery()
    ->getResult();


		}


}
