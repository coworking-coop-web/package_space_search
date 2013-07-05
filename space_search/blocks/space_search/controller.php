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
		$this->set('sl', $this->getSpaces($this->visa));
	}

	public function save($args) {
		$args['visa'] = (intval($args['visa']) > 0) ? 1 : 0;
		parent::save($args);
	}
	
	public function getSpaces($visa=0){
		// search coworking space
	}

}
