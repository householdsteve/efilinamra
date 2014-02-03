<?php

require_once 'includes/auth.php';

//custom account item class as account table abstraction
class class_participant extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name 				= 'participant';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
        // add a timestamp
        if (empty($data['participant_added'])) {
            $data['participant_added'] = date('Y-m-d H:i:s');
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
        if (empty($data['participant_updated'])) {
            $data['participant_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	public function remove($code) {
		return $this->delete('participant_code = ?', $code);		
	}
	
	/**
	 * get job by job participant Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		global $zfsession;
	
		$select = $this->_db->select()	
					->from(array('participant' => 'participant'))
					->joinLeft(array('campaign' => 'campaign'), 'campaign.campaign_code = participant.campaign_code')
					->joinLeft(array('campaigntype' => 'campaigntype'), 'campaigntype.campaigntype_code = campaign.campaigntype_code')
					->joinLeft(array('participantcategory' => 'participantcategory'), 'participantcategory.participantcategory_code = participant.participantcategory_code')
					->where('participant.campaign_code = ?', $zfsession->domainData['campaign_code'])
					->where('participant_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = NULL, $order = NULL)
	{
		global $zfsession;
	
		$select = $this->_db->select()	
					->from(array('participant' => 'participant'))	
					->joinLeft(array('campaign' => 'campaign'), 'campaign.campaign_code = participant.campaign_code')
					->joinLeft(array('campaigntype' => 'campaigntype'), 'campaigntype.campaigntype_code = campaign.campaigntype_code')
					->joinLeft(array('participantcategory' => 'participantcategory'), 'participantcategory.participantcategory_code = participant.participantcategory_code')
					->where('participant.campaign_code = ?', $zfsession->domainData['campaign_code'])
					->where('participant_deleted = 0')
					->where($where)
					->order($order);					
						
        $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;		
	}
	
	/**
	 * get all administrators ordered by column name
	 * example: $collection->getAlladministrators('administrator_title');
	 * @param string $order
     * @return object
	 */
	public function checkLogin($username = '', $password= '')
	{
		
		global $zfsession;
		
		$select = $this->_db->select()	
							->from(array('participant' => 'participant'))	
							->where('participant_username = ?', $username)
							->where('participant_active = 1')
							->where('participant_deleted = 0')
							->where('campaign_code = ?', $zfsession->domainData['campaign_code'])
							->where('participant_password = ?', $password);

	   $result = $this->_db->fetchRow($select);
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
						->from(array('participant' => 'participant'))	
					   ->where('participant_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;					   
	}
	
	function createPassword() {
		/* New reference. */
		$password = "";
		$codeAlphabet = "abcdefghigklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<6;$i++){
			$password .= $codeAlphabet[rand(0,$count)];
		}
		
		return $password;

	}
	
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= '0123456789';
		
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