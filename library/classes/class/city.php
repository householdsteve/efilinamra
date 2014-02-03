<?php

//custom account item class as account table abstraction
class class_city extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'city';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['city_added'])) {
            $data['city_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['city_updated'])) {
            $data['city_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('city_code = ?', $code);		
	}
	
	/**
	 * get job by job city Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('city' => 'city'))		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
					->where('city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')
					->where('city_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	/**
	 * get job by job city Id
 	 * @param string job id
     * @return object
	 */
	public function getByLink($link)
	{
		
		$select = $this->_db->select()	
					->from(array('city' => 'city'))		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
					->where('city.city_deleted = 0 and city.city_active = 1 and country.country_deleted = 0 and continent.continent_deleted = 0')				
					->where('city_link = ?', $link)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	public function getByCountry($code) {
		$select = $this->_db->select()	
					->from(array('city' => 'city'))		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
					->where('city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')				
					->where('country.country_code = ?', $code)
					->order('city_added asc');
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = NULL, $order = 'city_added asc')
	{		
		$select = $this->_db->select()
						->from(array('city' => 'city'))							
						->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
						->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
						->where('city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')					
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
						->from(array('city' => 'city'))	
					   ->where('city_code = ?', $reference)
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
	
	/* Front End. */
	public function getFrontByContinent($code) {
		$select = $this->_db->select()	
					->from(array('city' => 'city'))		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code')		
				
				/*	->joinLeft(array('cafe' => 'cafe'), 'cafe.city_code = city.city_code ')	
					
				 	->where('cafe.cafe_deleted = 0  and city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0 and cafe.cafe_active = 1')	*/
					->where('continent_active = 1 and continent_deleted = 0')
					
					
					->where('country_active = 1 and country_deleted = 0')
					->where('city_active = 1 and city_deleted = 0')
					->where('continent.continent_code = ?', $code)
					->order('city_name asc');
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}
	
	/* Front End. */
	public function getFrontAll() {
		$select = $this->_db->select()	
					->from(array('city' => 'city'))		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code')			
					->where('continent_active = 1 and continent_deleted = 0')
					->where('country_active = 1 and country_deleted = 0')
					->where('city_active = 1 and city_deleted = 0')
					->order('city_name asc');
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}	
	
}
?>