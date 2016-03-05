<?php

class Application_Model_User
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
			$this->setDbTable('Application_model_DbTable_User');	
		}
		return $this->_dbTable;
	}
	public function save($data)
	{
		if($id = $data['user_id'] === null)
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$smte = $db->insert($data);
			
		}	
	}
}