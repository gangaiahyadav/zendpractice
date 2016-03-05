<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        if($this->_helper->FlashMessenger->hasMessages()){
			$messages = $this->_helper->FlashMessenger->getMessages();
			$this->view->messages = $messages[0];	
			
		}
    }

    public function indexAction()
    {
        // action body
    }
	public function loginCheckAction()
    {
        try{
			if($this->_request->isPost() && $post =  $this->_request->getPost()){
				$email = $post['email'];
				$pwd   = $post['password'];
				$evalid = new Zend_Validate_EmailAddress(array(Zend_Validate_Hostname::ALLOW_DNS,'domain'=>true ));	
				if($evalid->isValid($email))
				{
					$db = $this->_getParam('db');
					$adapter = new Zend_Auth_Adapter_DbTable(
									$db,
									'user',
									'email',
									'password'
								);
					$adapter->setIdentity($email)->setCredential($pwd);
					$auth = Zend_Auth::getInstance();
					$result = $auth->authenticate($adapter);
				if($result->isValid()){
					$data = $adapter->getResultRowObject();
					$auth->getStorage()->write($data);
					$this->_helper->FlashMessenger(array('success'=>'Successfully Logged in'));	
					$this->_helper->redirector('index','index','default');
				}
				else{
					$this->_helper->FlashMessenger(array('failed'=>'Invalid Email or Password Provided, Please Try again'));	
					$this->_helper->redirector('index','login');
				}
			}
			}
		}catch(Exception $e){
			echo $e->getMessage();			
		}
    }
	
	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_helper->redirector('index','login');
	}


}

