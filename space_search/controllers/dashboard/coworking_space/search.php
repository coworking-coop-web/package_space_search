<?php
defined("C5_EXECUTE") or die(_("Access Denied."));

class DashboardCoworkingSpaceSearchController extends DashboardBaseController {
	
	public $helpers = array('form','html');

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
			$cs->save($this->post());
			$this->redirect('/dashboard/coworking_space/search', 'view_detail', $this->post('csID'), 'updated');
		} else {
			$this->view_detail($this->post('csID'));
		}		
	}
	
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
			$csID = CoworkingSpace::add($this->post());
			$this->redirect('/dashboard/coworking_space/search', 'view_detail', $csID, 'added');
		} else {
			$this->view_detail($this->post('csID'));
		}		
	}
	
	public function deleted() {
		$this->set("message", t('Coworking Space deleted successfully.'));
		$this->view();
	}
	
	public function add() {
		$this->view();
	}
	
	public function edit($csID = false) {
		Loader::model('coworking_space','space_search');
		
		$cs = CoworkingSpace::getByID($csID);
		$this->set('cs', $cs);
		$this->set('csID', $csID);
		
		$this->view();
	}

	public function view(){
		// load & set helpers
		$th = Loader::helper('text');
		$ph = Loader::helper('japanese_prefectures','space_search');
		$this->set('th',$th);
		$this->set('ph',$ph);
		
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
		
		if ($this->get('visa') == 1) {
			$spaceList->filterByVisa();
		}
		
		return $spaceList;
	}
	
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