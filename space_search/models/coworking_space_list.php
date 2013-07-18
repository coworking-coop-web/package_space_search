<?php
class CoworkingSpaceList extends DatabaseItemList {
	
	private $queryCreated;
	protected $itemsPerPage = 10;
	protected $autoSortColumns = array('spaceName');
	
	protected $onlyVisaSpaces=0;
	
	protected function setBaseQuery() {
		$this->setQuery('select csID from CoworkingSpace');
	}
	
	public function createQuery() {
		if (!$this->queryCreated) {
			$this->setBaseQuery();
			$this->queryCreated = 1;
		}
	}
	
	public function get($itemsToGet = 0, $offset = 0) {
		Loader::model('coworking_space','space_search');
		$coworkingSpaceList = array();
		$this->createQuery();
		$r = parent::get($itemsToGet, $offset);
		foreach ($r as $row) {
			$coworkingSpace = CoworkingSpace::getByID($row['csID']);
			$coworkingSpaceList[] = $coworkingSpace;
		}
		return $coworkingSpaceList;
	}
	
	public function getTotal() {
		$this->createQuery();
		return parent::getTotal();
	}
	
	public function filterBySpaceName($spaceName) {
		$this->filter('spaceName', '%' . $spaceName . '%', 'like');
	}
	
	public function filterByVisa() {
		$this->onlyVisaSpaces = 1;
		$this->filter('visa', 1);
	}
	
}