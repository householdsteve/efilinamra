<?php

//custom account item class as account table abstraction
class class_continent extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'continent';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['continent_added'])) {
            $data['continent_added'] = date('Y-m-d H:i:s');
        }

		return parent::insert($data);
		
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where)
    {
        // add a timestamp
        if (empty($data['continent_updated'])) {
            $data['continent_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('continent_code = ?', $code);		
	}
	
	/**
	 * get job by job continent Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('continent' => 'continent'))		
					->where('continent_deleted = 0')					
					->where('continent_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	public function getAll($where = NULL, $order = NULL)
	{
		
		$select = $this->_db->select()	
						->from(array('continent' => 'continent'))
						->where('continent_deleted = 0')					
						->where($where)
						->order($order);						
						
		return $this->_db->fetchAll($select);
	}
	
	public function pairs() {
		
		$select = $this->_db->select()	
						->from(array('continent' => 'continent'), array('continent.continent_code', 'continent.continent_name'))
						->where('continent_deleted = 0')
					   ->order('continent_name ASC');

		$result = $this->_db->fetchPairs($select);
		return ($result == false) ? false : $result = $result;
	}		
	
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('continent' => 'continent'))	
					   ->where('continent_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<8;$i++){
			$reference .= $codeAlphabet[rand(0,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}
	
	/* Front End functions. */
	public function getFrontAll()
	{
		
		$select = $this->_db->select()	
						->from(array('continent' => 'continent'))							
						->where('continent_active = 1 and continent_deleted = 0')
						->order('continent_name asc');						
						
	   $result = $this->_db->fetchAll($select);	
        return ($result == false) ? false : $result = $result;
	}
	
}
?>