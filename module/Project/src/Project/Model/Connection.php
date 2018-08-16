<?php
namespace Project\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Adapter\Adapter ;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;

 class Connection extends tableGateway {
      public function fetchprojectbystatus($status)
    {
/*     $var = "atom";
$statement  =$this ->Adapter->query('select global_status From project where name="'.$var.'"');
$results = $statement->execute();
/*$name = $row ['name'];
var_dump($name);*/
$status  = (string) $status;
$statement  =$this ->Adapter->query('select distinct(ap.project_id),(ap.project_name), ap.project_nature_en , ap.brief_description
from vw_all_companies c
inner join 	vw_all_company_products acp on acp.company_id = c.id
inner join vw_all_project_product app on app.product_id = acp.product_id
inner join vw_all_projects ap on ap.project_id = app.project_id
where c.is_lap="Y" and ap.status_en ="'. $status .'"
limit 15
');
$results = $statement->execute();
return $results ;
}

public function getProject($id)
{
      $id  = (string) $id;
      $statement  =$this ->Adapter->query('select * from vw_all_projects p where p.project_id='.$id.'');
      $results = $statement->execute();
      return $results ;
}
}
