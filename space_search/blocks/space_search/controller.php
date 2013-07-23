<?php

defined('C5_EXECUTE') or die("Access Denied.");

class SpaceSearchBlockController extends BlockController {

	protected $btTable = 'btSpaceSearch';
	protected $btInterfaceWidth = "300";
	protected $btInterfaceHeight = "300";
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	// this is super dangerous. I don't know why it even exists
	// if you have this set, and are doing something like outputting
	// an 'edit mode' message, that's what will be cached and displayed
	// to site visitors.
	protected $btCacheBlockOutputOnPost = false;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;

	/**
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Space Search Block.");
	}

	public function getBlockTypeName() {
		return t("Space Search");
	}

	public function view() {
		$spaceList = $this->getRequestedSearchResults();
		$spaceList->sortBy('spaceName','asc');
		$spaces = $spaceList->getPage();
		
		$this->set('spaceList', $spaceList);
		$this->set('spaces', $spaces);
		$this->set('filterByVisa',$this->visa);
	}

	public function save($args) {
		$args['visa'] = (intval($args['visa']) > 0) ? 1 : 0;
		parent::save($args);
	}
	
	public function getRequestedSearchResults() {
		Loader::model('coworking_space_list','space_search');
		
		$spaceList = new CoworkingSpaceList();
		
		if ($this->get('spaceName') != ''){
			$spaceList->filterBySpaceName($this->get('spaceName'));
		}
		
		if ($this->get('prefecture') != ''){
			$spaceList->filter('prefecture',$this->get('prefecture'),'=');
		}
		
		if ($this->get('ward') != ''){
			$spaceList->filter('ward',$this->get('ward'),'=');
		}
		
		if ($this->get('coop') == 1) {
			$spaceList->filterByCoop();
		}
		
		if ($this->get('visa') == 1) {
			$spaceList->filterByVisa();
		}
		
		return $spaceList;
	}

}
