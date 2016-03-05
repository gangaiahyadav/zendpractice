<?php

class RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        if($this->_helper->FlashMessenger->hasMessages())
		{
			$messages = $this->_helper->FlashMessenger->getMessages();
			$this->view->messages = $messages[0];
		}
    }

    public function indexAction()
    {
        try{
			$request = $this->getRequest();
			$form    = new Application_Form_Register();
			if($request->isPost()){
				//$validator = $form->getElement('cpassword')->getValidator('identical');
				//$validator->setToken($this->_request->getPost('password'));
				if($form->isValid($post = $request->getPost())){
					$data = array();
					$data['name'] 		= $post['fname'].' '.$post['lname'];
					$data['mobile']       = $post['mobile'];
					$data['email']		= $post['email'];
					$data['password']		= $post['password'];
					$model = new Application_Model_UserMapper();
				//	echo 'test';print_r($model->save($data)); die();
					if($model->save($data))
					{
						$this->_helper->FlashMessenger(array('success'=>'Successfully Inserted.'));
						$this->_helper->redirector('index','login');
					}else{
						$this->_helper->FlashMessenger(array('failed'=>'Not Inserted, Please Try Again'));
						$this->_helper->redirector('index','register');
					}				
				}	
			}
			$this->view->form = $form;
		}catch(Exception $e){
			echo $e->getMessage();	
		}
    }


}

