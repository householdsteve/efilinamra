<?php

//custom account item class as account table abstraction
class class_cafeimage extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected 	$_name 						= 'cafeimage';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['cafeimage_added'])) {
            $data['cafeimage_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['cafeimage_updated'])) {
            $data['cafeimage_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('cafeimage_code = ?', $code);		
	}
	
	/**
	 * get job by job cafeimage Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
	
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')	
					->where('cafeimage_deleted = 0')
					->where('cafeimage_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	/**
	 * get job by job cafeimage Id
 	 * @param string job id
     * @return object
	 */
	public function getByFeatured($code, $type)
	{
	
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')	
					->where('cafeimage_deleted = 0 and cafeimage_active = 1')
					->where('cafeimage_type in(\'FTR\', \'FTRL\',\'FTRX\')')
					->where('cafeimage_type = ?', $type)
					->where('cafe.cafe_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	/**
	 * get job by job cafeimagetype Id
 	 * @param string job id
     * @return object
	 */
	public function getByCafe($code)
	{
		global $zfsession;
		
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')		
					->where('cafeimage_deleted = 0')					
					->where('cafeimage.cafe_code = ?', $code);
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get job by job cafeimagetype Id
 	 * @param string job id
     * @return object
	 */
	public function getFeaturedByCafe($code)
	{
		global $zfsession;
		
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')		
					->where('cafeimage_deleted = 0')
					->where('cafeimage_type in(\'FTR\', \'FTRL\',\'FTRX\'  )')
					->where('cafeimage.cafe_code = ?', $code);
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	/**
	 * get job by job cafeimagetype Id
 	 * @param string job id
     * @return object
	 */
	public function getGalleryByCafe($code)
	{
		global $zfsession;
		
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')		
					->where('cafeimage_deleted = 0')
					->where('cafeimage_type in(\'GLY\')')
					->where('cafeimage.cafe_code = ?', $code)
					->order('cafeimage.cafeimage_order asc');
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}	
	
	public function getByOrder($code, $order) {
		
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')	
					->where('cafeimage_deleted = 0')
					->where('cafe.cafe_code = ?', $code)
					->where('cafeimage.cafeimage_order = ?', $order)
					->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;	
	}
	
	public function updateOrder($cafeimage, $neworder, $swaporder) {
		
		$item = $this->getByOrder($cafeimage['cafe_code'], $neworder);

		if($item) {

			$data = array();
			$where = null;
			$data['cafeimage_order'] = $swaporder;
			
			$where		= $this->getAdapter()->quoteInto('cafeimage_code = ?', $item['cafeimage_code']);
			$success	= $this->update($data, $where);				
		}
		
		$where = null;
		$data = array();
		$data['cafeimage_order'] = $neworder;
			
		$where		= $this->getAdapter()->quoteInto('cafeimage_code = ?', $cafeimage['cafeimage_code']);
		$success	= $this->update($data, $where);
		
		return $success;
	}
	
	public function getAll($where = NULL, $order = NULL)
	{
		$select = $this->_db->select()	
					->from(array('cafeimage' => 'cafeimage'))	
					->joinLeft(array('cafe' => 'cafe'), 'cafe.cafe_code = cafeimage.cafe_code')	
					->where('cafeimage_deleted = 0')				
					->where($where)
					->order($order);						
						
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
						->from(array('cafeimage' => 'cafeimage'))		
					   ->where('cafeimage_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;				   		
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "123456789";

		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<11;$i++){
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