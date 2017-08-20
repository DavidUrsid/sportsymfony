<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * ProductRepository
 *
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    

		
		public function findRecherche($id)
		{

			
	$qb= $this->createQueryBuilder('p')
			->orderBy('p.id' , 'asc')
           ->where('p.team = :id')
           ->andwhere('p.status!=  9')
           ->setParameter('id', $id);


           return $qb->getQuery()
    ->getResult();


		}

public function findIndex()
		{

			
	$qb= $this->createQueryBuilder('p')
			->orderBy('p.id' , 'asc')
           ->andwhere('p.status!=  9')
           ->setMaxResults(6)
           ;


           return $qb->getQuery()
    ->getResult();


		}


	


}
