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
where c.is_lap="Y" and ap.status_en ="'. $status .'" and app.product_id="LONG"
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

public function getRelatedUsers1 ($id) {
  $id  = (string) $id;
  $statement  =$this ->Adapter->query('select ap.first_name , ap.last_name , ap.email_address,apm.role_en, ap.job_title
from vw_all_project_members apm
inner join vw_all_people ap on ap.id = apm.person_id
where apm.project_id='.$id.'') ;
  $results = $statement->execute();
  return $results ;
}

public function getRelatedUsers2 ($id) {
  $id  = (string) $id;
  $statement  =$this ->Adapter->query('select  distinct(crpr.person_name), crpr.role
from vw_cr_person_role   crpr
inner join vw_cr_project  crp on crp.cr_id = crpr.cr_id
and crp.project_id = '.$id.'
');
  $results = $statement->execute();
  return $results ;
}

public function getCRJournals ($id) {
  $id  = (string) $id;
  $statement  =$this ->Adapter->query('select crj.cr_id , crj.journal , crj.entry_date   from vw_cr_all_journals crj
inner join vw_cr_project crp on crp.cr_id = crj.cr_id
where crp.project_id='.$id.' order by crj.entry_date desc
');
  $results = $statement->execute();
  return $results ;
}

public function getCallJournals ($id) {
  $id  = (string) $id;
  $statement  =$this ->Adapter->query('select acj.call_id , acj.entry_date , acj.journal from  vw_all_call_journals acj
inner join vw_call_project cp on cp.call_id = acj.call_id
where crp.project_id='.$id.'
');
  $results = $statement->execute();
  return $results ;
}

Public function getattachements ($id) {

}

public function getProjectStatus () {

}
public function getRelatedCalls ($id) {
  $id  = (string) $id;
  $statement  =$this ->Adapter->query('select  c.callid , c.call_type , c.call_status from vw_call_log c
inner join vw_call_project cp on cp.call_id=c.callid
where cp.project_id='.$id.'
');
  $results = $statement->execute();
  return $results ;
}
}
