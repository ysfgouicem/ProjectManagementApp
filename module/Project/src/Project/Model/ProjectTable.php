<?php
namespace Project\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ProjectTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
     public function fetchProjects($global_status)
     {
         $resultSet = $this->tableGateway->select(array('global_status' => $global_status));
         return $resultSet;
     }

     public function getProject($name)
     {
         $name  = (string) $name;
         $rowset = $this->tableGateway->select(array('name' => $name));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $name");
         }
         return $row;
     }

/*     public function saveProject(Project $project)
     {
         $data = array(
             'name' => $project->name,
             'nature'  => $project->nature,
             'status'  => $project->status,
             'description'  => $project->description,
             'global_status'  => $project->global_status,
             'project_leader'  => $project->project_leader,
         );

         $name = (int) $project->name;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAlbum($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
     }*/

  /*  public function deleteProject($name)
     {
         $this->tableGateway->delete(array('name' => (string) $name));
     }*/
 }
