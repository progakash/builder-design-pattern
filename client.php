<?php
//autoload src folder
require_once('vendor/autoload.php');

use BuilderDesignPattern\MysqlQueryBuilder;
use BuilderDesignPattern\SQLQueryBuilder;

function clientCode(SQLQueryBuilder $queryBuilder)
{
    $query = $queryBuilder
                ->select("users", ["name", "email", "password"])
                ->where("age", 18, ">")
                ->where("age", 30, "<")
                ->limit(10, 20)
                ->getSQL();

    echo $query;
}

echo "Testing MySQL query builder:\n";
clientCode(new MysqlQueryBuilder());

// echo "\n\n";
// $obj = new MysqlQueryBuilder();
// print_r($obj);
// $obj->getReset();

// $obj->select("users", ["name", "email", "password"]);
// echo $obj->getGenericClassProperty();

// $obj->select("users", ["name", "email", "password"]);
// $obj->where("age", 18, ">");
// print_r($obj->getGenericClassProperty());

// $obj->select("users", ["name", "email", "password"]);
// $obj->where("age", 18, ">");
// $obj->limit(10, 20);
// $obj->getSQL();
// print_r($obj->getGenericClassProperty());

?>