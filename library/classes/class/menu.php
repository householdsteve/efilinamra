<?php

//custom account item class as account table abstraction
class class_menu extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'menu';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['menu_added'])) {
            $data['menu_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['menu_updated'])) {
            $data['menu_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('menu_code = ?', $code);		
	}
	
	/**
	 * get job by job menu Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('menu' => 'menu'))		
					->joinLeft(array('category' => 'category'), 'category.category_code = menu.category_code')	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = menu.cafe_code')	
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code')	
					->where('menu_deleted = 0 and category.category_deleted = 0 and cafe.cafe_deleted = 0 and city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')
					->where('menu_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	public function getAll($where = NULL, $order = NULL)
	{
		
		$select = $this->_db->select()	
						->from(array('menu' => 'menu'))							
						->joinLeft(array('category' => 'category'), 'category.category_code = menu.category_code')	
						->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = menu.cafe_code')	
						->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code')		
						->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code')							
						->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code')				
						->where('menu_deleted = 0 and category.category_deleted = 0 and cafe.cafe_deleted = 0 and city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')
						->where($where)
						->order($order);						
						
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getCategoryCount($cafe) {
	
		$select = "select 
							c.category_code, 
							c.category_name,
							m.cafe_code,
							count(menu_code) menu_count
						from 
							category c,
							menu m
						where 
							c.category_code = m.category_code
							and m.menu_active = 1 
							and m.menu_deleted = 0
							and c.category_active = 1
							and c.category_deleted = 0
							and m.cafe_code = ?
						group by 
							c.category_code
						having count(menu_code) > 0";			
			
		$result = $this->_db->fetchAll($select, $cafe);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getByCategoryCode($code) {
	
		$select = $this->_db->select()	
						->from(array('menu' => 'menu'))							
						->joinLeft(array('category' => 'category'), 'category.category_code = menu.category_code')				
						->where('menu_deleted = 0 and menu_active = 1 and category.category_deleted = 0 and category.category_active = 1')
						->where('category.category_code = ?', $code)
						->order('menu.menu_name asc');				
						
	   $result = $this->_db->fetchAll($select);
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
						->from(array('menu' => 'menu'))	
					   ->where('menu_code = ?', $reference)
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