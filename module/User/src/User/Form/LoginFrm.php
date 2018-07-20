<?php

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
            'filters' => $filters,
            'validators' => array(
                array('name' => 'EmailAddress')
            ),
            'attributes' => array(
            'type' => 'text',
            'id'   => 'email_input',
            'class' => 'form-control',
            'palceholder' => 'insert mail here',
            'required' => 'required',
        ),
        ));

        $this->add(array(
            'name' => 'userpassword',
            'type' => 'Password',
            'required' => true,
            'attributes' => array(
              'id'   => 'password_input',
              'class' => 'form-control pass',
            ),
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
                'value' => 'Login',
                'id'   => 'login_btn',
                'class' => 'btn btn-lg btn-primary btn-block',
            ),
        ));
    }
}
