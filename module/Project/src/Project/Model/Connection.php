<?php
namespace Project\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Adapter\Adapter ;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;
 
 class Connection extends tableGateway {


public function fetch()
   {
     $var = "atom";
$statement  =$this ->Adapter->query('select global_status From project where name="'.$var.'"');
$results = $statement->execute();
/*$name = $row ['name'];
var_dump($name);*/
return $results ;
}
}
