<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class SpaceSearchPackage extends Package {

	// this must match the handle of your directory
	protected $pkgHandle = 'space_search';
	// make sure that you are not using functions unavailable in old versions
	// list of what you can do here:
	// http://www.concrete5.org/documentation/how-tos/developers/choose-what-c5-version-to-develop-for/
	//
	// note that many of the functions in this template might need Loader::('whatever') 
	// calls for older versions. 5.6 has an autoloader that makes sure most of these
	// classes are intiated on all requests. see /concrete/startup/autoload.php

	protected $appVersionRequired = '5.6.1.2';
	// by incrementing this when you add new functionality, deployment becomes
	// much much easier
	protected $pkgVersion = '0.0.3';

	// this will show on the installation screen in the dashboard
	public function getPackageDescription() {
		return t('Coworking Space Search Block and admin pages for coworking.coop site.');
	}

	// This can be anything you want, it doesn't have to line up with
	// the package handle. Note that it will be added to the database the
	// first time the package is read, and doesn't update after that.
	public function getPackageName() {
		return t('Coworking Space Package');
	}

	public function install($post = array()) {
//		
//		the post object is passed in if you are using the dashbord/install.php
//		package element. any form fields that you use in that element will
//		be elements of this array.  you do not need a form tag. check the 
//		element file for examples of syntax
//		
//		it's beneficial for installation to split things out into
//		separate functions for organization and ease of reading
//		

		$pkg = parent::install();
		$this->installBlocks($pkg);
		$this->installSinglePages($pkg);
	}

	public function upgrade() {

//		If you have an attribute type in your package that needs to
//		update it's database table, you will need to run this:
//		
//		$est = AttributeType::getByHandle('attribute_handle');
//		$path = $est->getAttributeTypeFilePath(FILENAME_ATTRIBUTE_DB);
//		Package::installDB($path);

		//parent::upgrade();
		//$pkg = Package::getByHandle($this->pkgHandle);
		//$this->installAdditionalPageAttributes($pkg);
	}
	
	private function installBlocks($pkg) {
		$bt = BlockType::getByHandle('space_search');
		if (!$bt || !is_object($bt)){
		   BlockType::installBlockTypeFromPackage('space_search', $pkg);
		}
	}

	private function installSinglePages($pkg) {
		Loader::model('single_page');

		$path = '/dashboard/coworking_space';
		$c = Page::getByPath($path);
		if (!$c || !is_object($c) || !$c->getCollectionID()) {
			// it doesn't exist, so now we add it
			$p = SinglePage::add($path, $pkg);
			if (is_object($p) && $p->isError() !== false) {
				$p->update(array('cName' => t('Coworking Space')));
			}
		}

		$path = '/dashboard/coworking_space/search';
		$c = Page::getByPath($path);
		if (!$c || !is_object($c) || !$c->getCollectionID()) {
			$p = SinglePage::add($path, $pkg);
			if (is_object($p) && $p->isError() !== false) {
				$p->update(array('cName' => t('Search')));
			}
		}
	}

	public function uninstall() {
		parent::uninstall();
		$db = Loader::db();
		$db->Execute('truncate table CoworkingSpace');
	}

}
