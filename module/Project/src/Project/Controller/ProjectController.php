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
            'Project' => $this->getConnection()->fetchprojectbystatus('Active'),
            'Project2' => $this->getConnection()->fetchprojectbystatus('Closed'),
            'Project3' => $this->getConnection()->fetchprojectbystatus('Released'),
            'Project4' => $this->getConnection()->fetchprojectbystatus('Proposed'),
            'Project5' => $this->getConnection()->fetchprojectbystatus('Abandoned'),
        ));
     }

     public function showProjectSetAction(){
        $data = $this->getConnection()->getProject('804');
        $request = $this->getRequest();
        $query = $request->getQuery();
        if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {
          $jsonData = array($data);
      $view = new JsonModel($jsonData);
      $view->setTerminal(true);
      return $view;
     }
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


 }
