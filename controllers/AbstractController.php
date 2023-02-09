<?php

namespace app\controllers;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class AbstractController
{
    protected Response $response;
    protected Request $request;
    protected QueryBuilder $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->request = Router::router()->getRequest();
        $this->response =  new Response($this->request);

        $connectionParams = [
            'dbname' => 'symfony',
            'user' => 'symfony',
            'password' => 'symfony',
            'host' => 'mysql',
            'driver' => 'pdo_mysql',
        ];
        $this->db = DriverManager::getConnection($connectionParams)->createQueryBuilder();
    }
}
