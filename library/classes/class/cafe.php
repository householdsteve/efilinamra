<?php

//custom account item class as account table abstraction
class class_cafe extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'cafe';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['cafe_added'])) {
            $data['cafe_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['cafe_updated'])) {
            $data['cafe_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('cafe_code = ?', $code);		
	}
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code and city.city_deleted = 0 ')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code and country.country_deleted = 0')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent.continent_deleted = 0')
					->where('cafe.cafe_deleted = 0 ')								
					->where('cafe_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	
	
		/**
	 * get job by cafe RESERVATION
 	
     * @return object
	 */
	public function getByReservation()
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
				    ->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code')	
					->where('cafe.cafe_deleted = 0 ')								
			    	->where('cafe.cafe_active = 1 ')
					->where('cafe_bookinglink<>""');
				
     
	   $result = $this->_db->fetchAll($select);
	   
	
        return ($result == false) ? false : $result = $result;

	}	
	
	
	
	
	
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function getByLinks($city, $cafe)
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code ')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
					->where('cafe.cafe_deleted = 0  and city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0')						
					->where('city_link = ?', $city)
					->where('cafe_link = ?', $cafe)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function getByCityLink($city)
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code ')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code ')
					->where('cafe.cafe_deleted = 0  and city.city_deleted = 0 and country.country_deleted = 0 and continent.continent_deleted = 0 and cafe.cafe_active = 1')						
					->where('city_link = ?', $city);

	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;

	}	
	
	/* Front . */
	function getValidateToFeature($code) {
		$select = "select 
							*
						from 
							cafe c 
								left join (select cafeimage_code as ftrcafeimage_code, cafeimage_code as ftrcode, cafeimage_extension as ftrext, cafeimage_path ftrpath, cafe_code from cafeimage where cafeimage_type = 'FTR' and cafeimage_deleted = 0 and cafeimage_active = 1) ftr
									on(ftr.cafe_code = c.cafe_code)
								left join (select cafeimage_code as ftrlcafeimage_code, cafeimage_code as ftrlcode, cafeimage_extension as ftrlext, cafeimage_path ftrlpath, cafe_code from cafeimage where cafeimage_type = 'FTRL' and cafeimage_deleted = 0 and cafeimage_active = 1) ftrl
									on(ftrl.cafe_code = c.cafe_code),
							city ci,
							country co,
							continent con
						where 	
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
							and ftr.ftrcafeimage_code is not null
							and ftrl.ftrlcafeimage_code is not null
							and c.cafe_code = ?";
		
		$result = $this->_db->fetchRow($select, $code);
        return ($result == false) ? false : $result = $result;
							
	}
	
	public function getByCity($code)
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code and city.city_deleted = 0 ')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code and country.country_deleted = 0')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent.continent_deleted = 0')
					->where('cafe.cafe_deleted = 0 ')	
						->where('city.city_code = ?', $code);
						
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = NULL, $order = NULL)
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code and city.city_deleted = 0 ')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code and country.country_deleted = 0')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent.continent_deleted = 0')
					
					->where('cafe.cafe_deleted = 0 ')
					//->where('cafe.cafe_active = 1 ')							
						->where($where)
						->order($order);						
						
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;
	}


public function getRnd()
	{
		
		$select = $this->_db->select()	
					->from(array('cafe' => 'cafe'))		
					->joinLeft(array('city' => 'city'), 'city.city_code = cafe.city_code and city.city_deleted = 0 ')		
					->joinLeft(array('country' => 'country'), 'country.country_code = city.country_code and country.country_deleted = 0')							
					->joinLeft(array('continent' => 'continent'), 'continent.continent_code = country.continent_code and continent.continent_deleted = 0')
					->joinLeft(array('cafeimage' => 'cafeimage'), 'cafeimage.cafe_code = cafe.cafe_code and cafeimage.cafeimage_type ="GLY" and cafeimage.cafeimage_active=1 and cafeimage.cafeimage_deleted=0 ')
					
				   // ->where('cafe.cafe_code = "V3184BOT" ')
					->where('cafe.cafe_deleted = 0 ')
					->where('cafe.cafe_active = 1 ')				
					->order('Rand()')
					->limit('1');				
						
	   $result = $this->_db->fetchAll($select);
	   
	  // print($select);
        return ($result == false) ? false : $result = $result;
	}




//SELECT * FROM cafe ORDER by Rand() limit 0,1

	
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('cafe' => 'cafe'))	
					   ->where('cafe_code = ?', $reference)
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
	
	/* Front . */
	function getFrontByCode($code) {
		$select = "select 
							*
						from 
							cafe c 
								left join (select cafeimage_code as ftrcode, cafeimage_extension as ftrext, cafeimage_path ftrpath, cafe_code from cafeimage where cafeimage_type = 'FTR' and cafeimage_deleted = 0 and cafeimage_active = 1) ftr
									on(ftr.cafe_code = c.cafe_code)
								left join (select cafeimage_code as ftrlcode, cafeimage_extension as ftrlext, cafeimage_path ftrlpath, cafe_code from cafeimage where cafeimage_type = 'FTRL' and cafeimage_deleted = 0 and cafeimage_active = 1) ftrl
									on(ftrl.cafe_code = c.cafe_code),
							city ci,
							country co,
							continent con
						where 	
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
							and c.cafe_code = ?";
		
		$result = $this->_db->fetchRow($select, $code);
        return ($result == false) ? false : $result = $result;
							
	}
	
	/* Front . */
	function getFeatureByContinent($code) {
		$select = "select 
							*
						from 
							cafe c 
								left join (select cafeimage_code as ftrcafeimage_code, cafeimage_code as ftrcode, cafeimage_extension as ftrext, cafeimage_path ftrpath, cafe_code from cafeimage where cafeimage_type = 'FTR' and cafeimage_deleted = 0 and cafeimage_active = 1) ftr
									on(ftr.cafe_code = c.cafe_code)
								left join (select cafeimage_code as ftrlcafeimage_code, cafeimage_code as ftrlcode, cafeimage_extension as ftrlext, cafeimage_path ftrlpath, cafe_code from cafeimage where cafeimage_type = 'FTRL' and cafeimage_deleted = 0 and cafeimage_active = 1) ftrl
									on(ftrl.cafe_code = c.cafe_code)
								left join (select cafeimage_code as ftrxcafeimage_code, cafeimage_code as ftrxcode, cafeimage_extension as ftrxext, cafeimage_path ftrxpath, cafe_code from cafeimage where cafeimage_type = 'FTRX' and cafeimage_deleted = 0 and cafeimage_active = 1) ftrx
									on(ftrx.cafe_code = c.cafe_code),
							city ci,
							country co,
							continent con
						where 	
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
							and ftr.ftrcafeimage_code is not null
							and ftrl.ftrlcafeimage_code is not null
							
							and c.cafe_featured = 1
							and con.continent_code = ?
							order by rand()";
		
		$result = $this->_db->fetchAll($select, $code);
        return ($result == false) ? false : $result = $result;
							
	}
	
	function getFrontByContinent($code) {
	
		$select = "select 
							*
						from 
							cafe c 
								left join (select cafeimage_code as ftrcode, cafeimage_extension as ftrext, cafeimage_path ftrpath, cafe_code from cafeimage where cafeimage_type = 'FTR' and cafeimage_deleted = 0 and cafeimage_active = 1) ftr
									on(ftr.cafe_code = c.cafe_code)
								left join (select cafeimage_code as ftrlcode, cafeimage_extension as ftrlext, cafeimage_path ftrlpath, cafe_code from cafeimage where cafeimage_type = 'FTRL' and cafeimage_deleted = 0 and cafeimage_active = 1) ftrl
									on(ftrl.cafe_code = c.cafe_code),
							city ci,
							country co,
							continent con
						where
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
							and con.continent_code = ?
							
							
							order by c.seq"
							
							
							;
		
		$result = $this->_db->fetchAll($select, $code);
        return ($result == false) ? false : $result = $result;	
		
	}
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function search($codes)
	{
		
		$codes = $codes == '' ? '' : str_replace(',', '',str_replace(' ', '_', $codes));
		
		$codesearch = $codes != "" ? "code like '%$codes%'" : '';
		
		$select = "select * from 
						(select 
							concat(con.continent_link, '_', co.country_link, '_', ci.city_link, '_', c.cafe_link) as code,
							concat(con.continent_name, ', ', co.country_name, ', ', ci.city_name, ', ', c.cafe_name) as name
						from 
							cafe c, 
							city ci,
							country co,
							continent con
						where
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
						union
							select
								concat(con.continent_link) as code,
								concat(con.continent_name) as name
							from 
								continent con
							where
								con.continent_deleted = 0 and con.continent_active = 1								
						union
							select
								concat(con.continent_link, '_', co.country_link) as code,
								concat(con.continent_name, ', ', co.country_name) as name
							from 
								country co,
								continent con
							where
								co.continent_code = con.continent_code
								and co.country_deleted = 0 and co.country_active = 1
								and con.continent_deleted = 0 and con.continent_active = 1								
						union
							select
								concat(con.continent_link, '_', co.country_link, '_', c.city_link) as code,
								concat(con.continent_name, ', ', co.country_name, ', ', c.city_name) as name
							from
								city c,
								country co,
								continent con
							where
								c.country_code = co.country_code
								and co.continent_code = con.continent_code
								and co.country_deleted = 0 and co.country_active = 1
								and con.continent_deleted = 0 and con.continent_active = 1) con 
							where 
								$codesearch
							order by con.name asc";
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function getBySearch($codes)
	{		
		$select = "select * from 
						(select 
							concat(con.continent_link, '_', co.country_link, '_', ci.city_link, '_', c.cafe_link) as code,
							concat(con.continent_name, ', ', co.country_name, ', ', ci.city_name, ', ', c.cafe_name) as name
						from 
							cafe c, 
							city ci,
							country co,
							continent con
						where
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
						union
							select
								concat(con.continent_link) as code,
								concat(con.continent_name) as name
							from 
								continent con
							where
								con.continent_deleted = 0 and con.continent_active = 1								
						union
							select
								concat(con.continent_link, '_', co.country_link) as code,
								concat(con.continent_name, ', ', co.country_name) as name
							from 
								country co,
								continent con
							where
								co.continent_code = con.continent_code
								and co.country_deleted = 0 and co.country_active = 1
								and con.continent_deleted = 0 and con.continent_active = 1								
						union
							select
								concat(con.continent_link, '_', co.country_link, '_', c.city_link) as code,
								concat(con.continent_name, ', ', co.country_name, ', ', c.city_name) as name
							from
								city c,
								country co,
								continent con
							where
								c.country_code = co.country_code
								and co.continent_code = con.continent_code
								and co.country_deleted = 0 and co.country_active = 1
								and con.continent_deleted = 0 and con.continent_active = 1) con 
							where 
								con.code = ?
							order by con.name asc";
       
	   $result = $this->_db->fetchRow($select, array($codes));
        return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get job by job cafe Id
 	 * @param string job id
     * @return object
	 */
	public function getAllSearch($code)
	{
		
		$select = "select 
							c.*, ci.*, co.*, con.*,
							concat(con.continent_link, '_', co.country_link, '_', ci.city_link, '_', c.cafe_link) as code,
							concat(con.continent_name, ', ', co.country_name, ', ', ci.city_name, ', ', c.cafe_name) as name
						from 
							cafe c, 
							city ci,
							country co,
							continent con
						where
							c.cafe_deleted = 0 and cafe_active = 1
							and ci.city_code = c.city_code
							and ci.city_deleted = 0 and ci.city_active = 1
							and co.country_code = ci.country_code
							and co.country_deleted = 0 and co.country_active = 1
							and con.continent_code = co.continent_code 
							and con.continent_deleted = 0 and con.continent_active = 1
							and concat(con.continent_link, '_', co.country_link, '_', ci.city_link, '_', c.cafe_link) like '%$code%'";
       
	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;

	}		
}
?>