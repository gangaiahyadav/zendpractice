<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
		$this->setMethod('post');
        $this->addElement('email','email',
							array('label'=>'Email',
								  'required'=>true,
								  'filters'=>array('stringTrim',),
								  'validators' => array('EmailAddress',)
							)
				);
		$this->addElement('password','password',array('label'=>'Password','required'=>true,'filters'=>array('stringTrim')));
		
    }
}