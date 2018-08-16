<?php
namespace Project\Model;

 use Zend\Db\TableGateway\TableGateway;
 /*use Zend\Db\Adapter\Adapter ;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;*/
 class ProjectTable
 {
     protected $tableGateway;
  //  protected $select;
        /* constructor  of the TableGateway   */
     public function __construct(TableGateway $tableGateway)
     {
  //       $this->tableGateway = $tableGateway;
  //        $this->select = new Select();
     }
     /* method using join between project and user   */
     public function   userfetch() {
      /* $sqlSelect = $this->tableGateway->getSql()->select();
       $sqlSelect->columns(array('name','nature','description','status','global_status'));
       $sqlSelect->join('user', 'user.id = project.project_leader', array('user_email'), 'left');

/* --------------------------------------------------  use below fo multiple join ------------------------------------------
                $select = $db->select();
$select->from(array('p' => 'person'), array('person_id', 'name', 'dob'))
       ->join(array('pa' => 'Person_Address'), 'pa.person_id = p.person_id', array())
       ->join(array('a' => 'Address'), 'a.address_id = pa.address_id', array('address_id', 'street', 'city', 'state', 'country'));


      $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($sqlSelect);
       $resultSet = $statement->execute();
       return $resultSet;*/
      }

     public function fetchAll()
     { //   $resultSet = $this->tableGateway->select();
        //  return $resultSet;
     }

     public function womeguser(){
    /*    $query="select * from user" ;
       $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($query);
        $resultSet = $statement->execute();
        return $resultSet;*/
     }


     public function fetchProjects($global_status)
     {
  //       $resultSet = $this->tableGateway->select(array('global_status' => $global_status));
    //     return $resultSet;
     }

     public function getProject($name)
     {
  /*       $name  = (string) $name;
         $rowset = $this->tableGateway->select(array('name' => $name));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $name");
         }
         return $row;
     }*/
 }
