<?php

class Application_Model_UserMapper
{
	protected $_dbTable;
	protected function setDbTable($dbTable)
	{
		if(is_string($dbTable))
		{
			$dbTable = new $dbTable();				
		}
		if(!$dbTable instanceof Zend_Db_Table_Abstract)
		{
			throw new Exception('Invalid Table Gateway Provided');	
		}
		return $this->_dbTable = $dbTable;
	}
	protected function getDbTable()
	{
		if($this->_dbTable === null)
		{
			$this->setDbTable('Application_Model_DbTable_User');	
		}
		return $this->_dbTable;
	}
	public function save($data)
	{
		//print_r($this->_dbTable); die();
		if(!isset($data['user_id']) && null === ($id = $data['user_id']))
		{
			//$db = Zend_Db_Table::getDefaultAdapter();
			unset($data['user_id']);
			return $this->getDbTable()->insert($data);			
		}else{
			return $this->getDbTable()->update($data,array('user_id = ?',$id));	
		}	
		
	}

}

