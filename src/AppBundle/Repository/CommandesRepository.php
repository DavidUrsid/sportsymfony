<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * CommandesRepository
 *
 */
class CommandesRepository extends \Doctrine\ORM\EntityRepository
{

    

		
		public function findLastId($user)
		{

			
	$qb= $this->createQueryBuilder('c')
			->orderBy('c.id' , 'desc')
           ->where('c.user= :user')
           ->setMaxResults(1)
           ->setParameter('user', $user);


           return $qb->getQuery()
    ->getResult();


		}



	


}
