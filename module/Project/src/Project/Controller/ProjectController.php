<?php
namespace Project\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class ProjectController extends AbstractActionController
 {
    protected $ProjectTable;
    protected $Connection;
     public function indexAction()
     {
       return new ViewModel(array(
      /*    'user' => $this->getProjectTable()->userfetch(),
      /*      'Projects' => $this->getProjectTable()->fetchAll(),
            'ClosedProjects' => $this->getProjectTable()->fetchProjects("closed"),
            'ActiveProjects' => $this->getProjectTable()->fetchProjects("active"),
            'OnholdProjects' => $this->getProjectTable()->fetchProjects("on hold"),*/
            'Project' => $this->getConnection()->fetchprojectbystatus('Active'),
            'Project2' => $this->getConnection()->fetchprojectbystatus('Closed'),
            'Project3' => $this->getConnection()->fetchprojectbystatus('Released'),
            'Project4' => $this->getConnection()->fetchprojectbystatus('Proposed'),
            'Project5' => $this->getConnection()->fetchprojectbystatus('Abandoned'),
        ));
     }

     public function editAction()
     {
     }


     public function showAction()
     {
       $paramName = $this->getEvent()->getRouteMatch()->getParam('id');
       return new ViewModel (
         array(
              'Project' => $this->getConnection()->getProject($paramName),
         ));
     }

     public function getConnection()
         {
             if (!$this->Connection) {
                 $sm = $this->getServiceLocator();
                 $this->Connection = $sm->get('Project\Model\Connection');
             }
             return $this->Connection;
         }

     public function getProjectTable()
     {
         if (!$this->ProjectTable) {
             $sm = $this->getServiceLocator();
             $this->ProjectTable = $sm->get('Project\Model\ProjectTable');
         }
         return $this->ProjectTable;
     }

     public function ajaxAction() {
   $data =$this->getConnection()->fetchprojectbystatus('Active') ;
   $request = $this->getRequest();
   $query = $request->getQuery();
   if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {
      $jsonData = array();
      $idx = 0;
      foreach($data as $row) { 
         $temp = array(
            'id' => $row['project_id'],
            'name' => $row['project_name'],
            'nature' => $row['project_nature_en'],
            'description' => $row['brief_description']
         );
         $jsonData[$idx++] = $temp;
      }
      $view = new JsonModel($jsonData);
      $view->setTerminal(true);
   } else {
      $view = new ViewModel();
   }
   return $view;
}
 }
