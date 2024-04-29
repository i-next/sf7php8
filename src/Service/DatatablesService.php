<?php

namespace App\Service;

use App\Service\DatatablesServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

class DatatablesService implements DatatablesServiceInterface
{
    private $filter = false;
    private $recordTotal = 0;
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function getData(string $repositoryName,Request $request, array $join = []): array
    {
        $dataRequest = $request->request->all();

        $result = [];
        $result['draw'] = $dataRequest['draw'];
        $repository = $this->getRepository($repositoryName);
        $queryBuilder = $this->queryBuilder($repository,$dataRequest,$join);

        if($this->recordTotal === 0){
            $recordsTotal = count($repository->findAll());
        }

        $result['recordsTotal'] = $this->recordTotal;

        $result['recordsFiltered'] = count($queryBuilder->getQuery()->getArrayResult());
        $queryBuilder = $this->queryPagination($queryBuilder,null,$dataRequest);

        $result['data'] = $queryBuilder->getQuery()->getArrayResult();

        return $result;
    }

    private function getRepository(string $repositoryName): EntityRepository
    {
        $repo = 'App\Entity\\'.$repositoryName;
        return $this->entityManager->getRepository($repo);
    }

    private function queryBuilder(EntityRepository $repository,array $data, array $join): QueryBuilder
    {

        $qb = $repository->getQueryBuilder();
        if($qb instanceof QueryBuilder && $join){
            foreach($join as $tablejoin){

                $qb->leftJoin('q.'.$tablejoin,$tablejoin)->where($tablejoin.' = q.'.$tablejoin)->addSelect($tablejoin);
                if($tablejoin === 'strain'){
                    $qb->leftJoin('strain.breeder', 'breeder')->where('breeder = strain.breeder')->addSelect('breeder');
                }
            }
        }

        $qb = $this->queryFilters($qb, $data);

        if("" !== $data['search']['value']){
            $qb = $this->querySearch($qb,null,$data['search']['value']);
        }

        if(array_key_exists('order',$data) && $orders = $data['order']){
            foreach($orders as $order){

                if($order['name']){
                    if($order = $orders[array_key_first($orders)]){
                        if(str_contains($order['name'],'.')){
                            $qb->orderBy($order['name'],$order['dir']);
                        }else{
                            $qb->orderBy('q.'.$order['name'],$order['dir']);
                        }
                    }else{
                        if(str_contains('.',$order['name'])){
                            $qb->addOrderBy($order['name'],$order['dir']);
                        }else{
                            $qb->addOrderBy('q.'.$order['name'],$order['dir']);
                        }
                    }
                }
            }
        }
      return $qb;
    }

    private function querySearch(?QueryBuilder $builder,?EntityRepository $repository,string $search): QueryBuilder
    {
        if(is_null($builder) && !is_null($repository)){
            $builder = $repository->getQueryBuilder();
        }
        if($builder instanceof  QueryBuilder){
            if(!$this->filter){
                $builder->where('q.name LIKE :search');
                $this->filter = true;
            }else{
                $builder->andWhere('q.name LIKE :search');
            }
            $builder->setParameter('search','%'.$search.'%');
        }
        return $builder;
    }

    private function queryPagination(?QueryBuilder $builder,?EntityRepository$repository,array $data): QueryBuilder
    {
        if(is_null($builder) && !is_null($repository)){
            $builder = $repository->getQueryBuilder();
        }
        if($builder instanceof  QueryBuilder){
            if( "-1" !== $data['length']){
                $builder->setMaxResults($data['length']);
            }
            if($offset = $data['start']){
                $builder->setFirstResult($offset);
            }
        }
        return $builder;
    }

    private function queryFilters(QueryBuilder $builder, array $data): QueryBuilder
    {
        if(array_key_exists('filters',$data)){
            foreach ($data['filters'] as $keyfilter => $filter){
                if(!$this->filter){
                    if(is_array($filter)){
                        $builder = $this->multifiters($keyfilter,$filter,$builder);
                    }else{
                        $builder->where('q.'.$keyfilter.' = '.$filter);
                    }
                    $this->filter = true;

                }else{
                    $builder->andWhere('q.'.$keyfilter.' = '.$filter);
                }
            }
        }
        $this->recordTotal = count($builder->getQuery()->getArrayResult());
        return $builder;
    }

    private function multifiters(string $key,array $filters, QueryBuilder $builder): QueryBuilder
    {
        foreach($filters as $keyfilter => $filter){
            //$filter = $filter == "null" ? null : $filter;
            if($keyfilter === array_key_first($filters)){
                if($filter == "null"){
                    $builder->where('q.'.$key.' IS NULL');
                }else{
                    $builder->where('q.'.$key.' = '.$filter);
                }
            }else{
                $builder->orWhere('q.'.$key.' = '.$filter);
            }
        }
        return $builder;
    }

}
