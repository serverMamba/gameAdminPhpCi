<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Track_event_model extends MY_Model {
	public function __construct() 
	{
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	/**
	 * 获取所有的数据
	 * @return multitype:NULL
	 */
	public function getAllEvents()
	{
		$dbData = $this->db->select('event')->from('smc_track_event')->get()->result_array();

		$allEvents = array();
		for($i = 0; $i < count($dbData); $i++)
		{
			$allEvents[] = $dbData[$i]['event'];
		}
		
		return $allEvents;
	}
	
	/**
	 * 获取所有时间，包含名字
	 * @return unknown
	 */
	public function getAllEventsWithName()
	{
		$dbData = $this->db->select('event', 'name')->from('smc_track_event')->get()->result_array();

		return $dbData;
	}
}