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
          'user' => $this->getProjectTable()->userfetch(),
            'Projects' => $this->getProjectTable()->fetchAll(),
            'ClosedProjects' => $this->getProjectTable()->fetchProjects("closed"),
            'ActiveProjects' => $this->getProjectTable()->fetchProjects("active"),
            'OnholdProjects' => $this->getProjectTable()->fetchProjects("on hold"),
            'Project' => $this->getConnection()->fetch(),
        ));
     }

     public function editAction()
     {
     }


     public function showAction()
     {
       $paramName = $this->getEvent()->getRouteMatch()->getParam('name');  // getting the name from the url
       return new ViewModel (
         array(
              'Project' => $this->getProjectTable()->getProject($paramName),
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
 }
