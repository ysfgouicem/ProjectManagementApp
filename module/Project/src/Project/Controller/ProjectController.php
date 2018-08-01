<?php
namespace Project\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


 class ProjectController extends AbstractActionController
 {
    protected $ProjectTable;

     public function indexAction()
     {
       return new ViewModel(array(
          'user' => $this->getProjectTable()->userfetch(),
            'Projects' => $this->getProjectTable()->fetchAll(),
            'ClosedProjects' => $this->getProjectTable()->fetchProjects("closed"),
            'ActiveProjects' => $this->getProjectTable()->fetchProjects("active"),
            'OnholdProjects' => $this->getProjectTable()->fetchProjects("on hold"),
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

     public function getProjectTable()
     {
         if (!$this->ProjectTable) {
             $sm = $this->getServiceLocator();
             $this->ProjectTable = $sm->get('Project\Model\ProjectTable');
         }
         return $this->ProjectTable;
     }
 }
