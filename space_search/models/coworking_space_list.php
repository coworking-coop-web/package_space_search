<?php
class CoworkingSpaceList extends DatabaseItemList {

	public $onlyVisaSpaces=0;

	public function __construct() {
		$this->setQuery('select gsID from GroupSets');
		$this->sortBy('gsName', 'asc');
	}
	
	protected function createQuery(){
		if(!$this->queryCreated){
			$this->setBaseQuery();
			$this->queryCreated = 1;
		}
	}
	
	public function filterByVisa($val) {
		$this->onlyVisaSpaces = $val;
		$this->filter('s.visa', $val);
	}	
	
	protected function setBaseQuery() {
		$this->setQuery('SELECT s.id, s.spaceName, s.prefecture, s.ward, s.address, s.url, s.email, s.tel, s.coop, s.visa FROM CoworkingSpace s ');
	}
}