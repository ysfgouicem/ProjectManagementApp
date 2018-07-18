<?php
/*
 * Module: User
 */

namespace User\Form\Filter;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{
    public $useremail;
    public $userpassword;
    protected $inputFilter;

    public function getInputFilter()
    {
        if(!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $filters = array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            );

            $inputFilter->add(array(
                'name' => 'useremail',
                'required' => true,
                'filters' => $filters,
                'validators' => array(
                    array('name' => 'EmailAddress')
                ),
            ));

            $inputFilter->add(array(
                'name' => 'userpassword',
                'required' => true,
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
