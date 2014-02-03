<?php

//custom account item class as account table abstraction
class class_country extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'country';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['country_added'])) {
            $data['country_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['country_updated'])) {
            $data['country_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('country_code = ?', $code);		
	}
	
	/**
	 * get job by job country Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('country' => 'country'))		
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent_deleted = 0')							
					->where('country_deleted = 0')
					->where('country_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	public function getByContinent($code) {
		$select = $this->_db->select()	
						->from(array('country' => 'country'))							
						->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent_deleted = 0')	
						->where('country_deleted = 0 and country_active = 1')
						->where('country.continent_code = ?', $code)
						->order('country_name asc');						
						
		return $this->_db->fetchAll($select);	
	}
	
	public function getAll($where = NULL, $order = NULL)
	{
		
		$select = $this->_db->select()	
						->from(array('country' => 'country'))							
						->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent_deleted = 0')	
						->where('country_deleted = 0')					
						->where($where)
						->order($order);						
						
		return $this->_db->fetchAll($select);
	}
	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('country' => 'country'))	
					   ->where('country_code = ?', $reference)
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
}
?>