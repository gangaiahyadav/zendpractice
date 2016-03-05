<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
		$this->addElement('text','fname',array('label'=>'First Name','required'=>true,'filters'=>array('stringTrim'),'validators'=>array('Alpha')));
		$this->addElement('text','lname',array('label'=>'Last Name','required'=>true,'filters'=>array('stringTrim'),'validators'=>array('Alpha')));
		$this->addElement('text','mobile',array('label'=>'Mobile No','required'=>true,'filters'=>array('stringTrim'),'validators'=>array('Digits'	)));
		$this->addElement('text','email',array('label'=>'Email','required'=>true,'filters'=>array('stringTrim'),'validators'=>array('EmailAddress')));
		$this->addElement('password','password', array(
                'required'   => true,
                'label'      => 'Password:',
                'filters'    => array('StringTrim'),
                'validators' => array(
                    'NotEmpty',
                    array('StringLength', false, array(6))
                )
            ));
		$this->addElement('password','cpassword',array('label'=>'Confirm Password','required'=>true,'filters'=>array('StringTrim'),'validators'=>array('NotEmpty',array('StringLength',false,array(6),array('Identical',false,'password')))));
		
		
		$this->addElement('submit','submit',array('label'=>'Sign In','ignore'=>true));
		$this->addElement('hash','csrf',array('ignore'=>true));
    }
}

