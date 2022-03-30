<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $idOrder, int $idClient, array $evaluation);  
    public function getEvaluationByOrder(int $idOrder);  
    public function getEvaluationByClient(int $idClient);  
    public function getEvaluationsById(int $id);  
    public function getEvaluationsByOrderIdByClientId(int $idOrder, int $idClient);  
}
