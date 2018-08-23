<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

 class ProjectController extends AbstractActionController
 {
    protected $ProjectTable;
    protected $Connection;

     public function indexAction()
     {          return new ViewModel(array(
           'Project' => $this->getConnection()->fetchprojectbystatus('Active'),
            'Project2' => $this->getConnection()->fetchprojectbystatus('Closed'),
            'Project3' => $this->getConnection()->fetchprojectbystatus('Released'),
            'Project4' => $this->getConnection()->fetchprojectbystatus('Proposed'),
            'Project5' => $this->getConnection()->fetchprojectbystatus('Abandoned'),
        ));
     }



     public function showAction()
     {
       $paramName = $this->getEvent()->getRouteMatch()->getParam('id');
       return new ViewModel (
         array(
              'Project' => $this->getConnection()->getProject($paramName),
              'Timeline' => $this->getConnection()->getProjectTimeline(),
              'RelatedUsers' => $this->getConnection()->getRelatedUsers1($paramName),
              'RelatedUsers2' => $this->getConnection()->getRelatedUsers2($paramName),
              'Calls_Journals' => $this->getConnection()->getCallJournals($paramName),
              'CR_Journals' => $this->getConnection()->getCRJournals($paramName),
              'Calls' => $this->getConnection()->getRelatedCalls($paramName),
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
