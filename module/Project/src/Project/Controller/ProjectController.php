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
       /* -------------------- reading from Spreadsheet --------------------------------- */
         $spreadsheet = new Spreadsheet();
      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
      $reader->setReadDataOnly(TRUE);
      $spreadsheet = $reader->load("test.xlsx");
      $dataArray = $spreadsheet->getActiveSheet()
    ->rangeToArray(
        'C3:C15',     // The worksheet range that we want to retrieve
        'empty',        // Value that should be returned for empty cells
        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        TRUE         // Should the array be indexed by cell row and cell column
    );

       return new ViewModel(array(
          'user' => $this->getProjectTable()->userfetch(),
            'Projects' => $this->getProjectTable()->fetchAll(),
            'ClosedProjects' => $this->getProjectTable()->fetchProjects("closed"),
            'ActiveProjects' => $this->getProjectTable()->fetchProjects("active"),
            'OnholdProjects' => $this->getProjectTable()->fetchProjects("on hold"),
            'Spreadsheet' => $dataArray,
        ));
     }

     public function editAction()
     {
     }


     public function showAction()
     {
       $paramName = $this->getEvent()->getRouteMatch()->getParam('name');  // getting the name fmro the url
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
