<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * TapaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TapaRepository extends \Doctrine\ORM\EntityRepository
{
    /*public function allTapas($currentPage = 1, $limit = 3)
  {
      // Create our query
      $query = $this->createQueryBuilder('p')
          ->getQuery();


      $paginator = $this->paginaTapas($query, $currentPage, $limit);

      return array('paginator' => $paginator, 'query' => $query);
  }
  public function paginaTapas($dql, $page = 1, $limit = 3)
  {
      $paginator = new Paginator($dql);

      $paginator->getQuery()
          ->setFirstResult($limit * ($page - 1)) // Offset
          ->setMaxResults($limit); // Limit

      return $paginator;
  }*/
}
