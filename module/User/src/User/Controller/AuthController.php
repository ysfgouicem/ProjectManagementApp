<?php
/*
 * Module   : User
 * Filename : AuthController.php


 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\LoginFrm;
use User\Form\Filter\LoginFilter;
use Libraries\UserPassword;
use Zend\Session\Container;

class AuthController extends AbstractActionController
{
    protected $storage;
    protected $authservice;

    public function getAuthService()
    {
        if(!$this->authservice)
        {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }

    public function loginAction()
    {
        if($this->getAuthService()->hasIdentity())
        {
            return $this->redirect()->toUrl('/ProjectManagementApp/public/project');
        }
        $form = new LoginFrm();
        if($this->getRequest()->isPost())
        {
            $filter = new LoginFilter();
            $form->setInputFilter($filter->getInputFilter());
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if($form->isValid())
            {
                $userPassword = new UserPassword();
                $encryptPassword = $userPassword->create($data['userpassword']);

                $this->getAuthService()->getAdapter()->setIdentity($data['useremail'])->setCredential($encryptPassword);
                $result = $this->getAuthService()->authenticate();

                if($result->isValid())
                {
                    $session = new Container('User');
                    $session->offsetSet('email', $data['email']);

                    $this->redirect()->toUrl('/ProjectManagementApp/public/project');
                }
                else
                {
                    print '<p>Login Failure</p>';
                }
            }
        }
        return array('form' => $form);
    }

    public function logoutAction()
    {
        $session = new Container('User');
        $session->getManager()->destroy();
        $this->getAuthService()->clearIdentity();
        return $this->redirect()->toUrl('/ProjectManagementApp/public/user/login');
    }
}
