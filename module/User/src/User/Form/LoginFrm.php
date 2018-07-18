<?php
/*
 * Module   : User
 * Filename : LoginFrm.php
 * Author   : Vinoj Cardoza
 * Created  : 8th March 2015
 */

namespace User\Form;

use Zend\Form\Form;

class LoginFrm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('login');

        $filters = array(
            array('name' => 'StripTags'),
            array('name' => 'StringTrim')
        );

        $this->add(array(
            'name' => 'useremail',
            'type' => 'Text',
            'filters' => $filters,
            'validators' => array(
                array('name' => 'EmailAddress')
            ),
        ));

        $this->add(array(
            'name' => 'userpassword',
            'type' => 'Password',
            'required' => true,
        ));

        $this->add(array(
            'name' => 'loginCsrf',
            'type' => 'Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3600,
                ),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Login'
            ),
        ));
    }
}
