<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * SizeProductRepository
 *
 */
class SizeProductRepository extends \Doctrine\ORM\EntityRepository
{

    

		
		public function findByProduct($product_id)
		{

			
	$qb= $this->createQueryBuilder('s')
           ->where('s.product= :product_id')
           ->setParameter('product_id', $product_id);


           return $qb;


		}


}
