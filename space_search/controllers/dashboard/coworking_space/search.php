<?php
defined("C5_EXECUTE") or die(_("Access Denied."));

class DashboardCoworkingSpaceSearchController extends DashboardBaseController {
	
	public $helpers = array('form','html');
	
	public function on_start() {
		// load & set helpers
		$th = Loader::helper('text');
		$ph = Loader::helper('japanese_prefectures','space_search');
		$this->set('th',$th);
		$this->set('ph',$ph);
		
		$this->error = Loader::helper('validation/error');
	}
	
	/**
	 * delete coworking space data
	 */
	public function delete($csID = null, $token = null){
		Loader::model('coworking_space','space_search');
		
		try {
			$cs = CoworkingSpace::getByID($csID); 
				
			if(!($cs instanceof CoworkingSpace)) {
				throw new Exception(t('Invalid Coworking Space ID.'));
			}
	
			$valt = Loader::helper('validation/token');
			if (!$valt->validate('delete', $token)) {
				throw new Exception($valt->getErrorMessage());
			}
			
			$cs->delete();
			
			$this->redirect("/dashboard/coworking_space/search", 'deleted');
		} catch (Exception $e) {
			$this->error->add($e);
		}
		$this->view();
	}
	
	/**
	 * update coworking space data
	 */
	public function save() {
		Loader::model('coworking_space','space_search');
		
		$valt = Loader::helper('validation/token');
		if (!$valt->validate('save')) {
			$this->error->add($valt->getErrorMessage());
		}
		
		$spaceName = trim($this->post('spaceName'));
		if (!$spaceName) { 
			$this->error->add(t('Please include a name.'));
		}
		
		if (!$this->error->has()) {
			$cs = CoworkingSpace::getByID($this->post('csID'));
			if (is_object($cs)) {
				$res = $cs->save($this->post());
				if ($res) {
					$this->redirect('/dashboard/coworking_space/search', 'view_detail', $this->post('csID'), 'updated');
				} else {
					$db = Loader::db();
					$this->error->add($db->ErrorMsg());
					$this->set('error',$this->error);
				}
			} else {
				$this->redirect('/dashboard/coworking_space/search');
			}
		} else {
			$this->edit($this->post('csID'));
		}		
	}
	
	/**
	 * add new coworking space data
	 */
	public function submit_add() {
		Loader::model('coworking_space','space_search');
		
		$valt = Loader::helper('validation/token');
		if (!$valt->validate('submit_add')) {
			$this->error->add($valt->getErrorMessage());
		}
		
		$spaceName = trim($this->post('spaceName'));
		if (!$spaceName) { 
			$this->error->add(t('Please include a name.'));
		}
		
		if (!$this->error->has()) {
			$cs = CoworkingSpace::add($this->post());
			if (is_object($cs))
				$this->redirect('/dashboard/coworking_space/search', 'view_detail', $cs->csID, 'added');
		} else {
			$this->edit();
		}		
	}
	
	/**
	 * completed delete task
	 */
	public function deleted() {
		$this->set("message", t('Coworking Space deleted successfully.'));
		$this->view();
	}
	
	/**
	 * show add coworking space form
	 */
	public function add() {
		$this->view();
	}
	
	/**
	 * show edit coworking space form
	 */
	public function edit($csID = false) {
		Loader::model('coworking_space','space_search');
		
		$cs = CoworkingSpace::getByID($csID);
		$this->set('cs', $cs);
		$this->set('csID', $csID);
		
		$this->view();
	}

	/**
	 * show coworking spaces list
	 */
	public function view(){
		// set search action url
		$url = Loader::helper('concrete/urls');
		$urlSearchAction = $url->getToolsURL('coworking_space/search_results', 'space_search');
		$this->set('urlSearchAction',$urlSearchAction);
		
		// get search results
		$spaceList = $this->getRequestedSearchResults();
		if (is_object($spaceList)) {
			// setup advanced search
			$this->addHeaderItem('<script type="text/javascript">$(function() { ccm_setupAdvancedSearch(\'coworking-space\'); });</script>');
			
			// get items
			$spaceList->setItemsPerPage(20);
			$spaceList->sortBy('spaceName','asc');
			$spaces = $spaceList->getPage();
			
			$this->set('spaceList', $spaceList);
			$this->set('spaces', $spaces);
		}
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
	
	/**
	 * show coworking space detail
	 */
	public function view_detail($csID = false, $message = false) {
		Loader::model('coworking_space','space_search');
		
		$cs = CoworkingSpace::getByID($csID);
		if (!is_object($cs)) {
			$this->redirect("/dashboard/coworking_space/search");
		}
		switch($message) {
			case 'updated':
				$this->set('message', t('Coworking Space updated successfully.'));
				break;
			case 'added':
				$this->set('message', t('New Coworking Space added.'));
				break;
		}
		
		$this->set('cs', $cs);
	}

}