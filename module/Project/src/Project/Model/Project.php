<?php
namespace Project\Model;

class Project
{  /* projects variables */
    public $name;
    public $nature;
    public $description;
    public $status;
    public $global_status;
//    public $project_leader;

    public function exchangeArray($data)
    {
        $this->name     = (!empty($data['name'])) ? $data['name'] : null;
        $this->nature = (!empty($data['nature'])) ? $data['nature'] : null;
        $this->description  = (!empty($data['description'])) ? $data['description'] : null;
        $this->status  = (!empty($data['status'])) ? $data['status'] : null;
        $this->global_status  = (!empty($data['global_status'])) ? $data['global_status'] : null;
//       $this->$project_leader  = (!empty($data['$project_leader'])) ? $data['$project_leader'] : null;
    }
}
