<?php 
defined('C5_EXECUTE') or die("Access Denied.");

// load helpers
$th = Loader::helper('text');
$ph = Loader::helper('japanese_prefectures','space_search');

// load search action url
$url = Loader::helper('concrete/urls');
$urlSearchAction = $url->getToolsURL('coworking_space/search_results', 'space_search');

// load dashboard search page controller
$controller = Loader::controller('/dashboard/coworking_space/search');

// get search results
$spaceList = $controller->getRequestedSearchResults();

// get items
$spaceList->setItemsPerPage(20);
$spaces = $spaceList->getPage();

// load element
Loader::packageElement(
	'coworking_space/search_results', 'space_search', array(
	'th' => $th,
	'ph' => $ph,
	'urlSearchAction' => $urlSearchAction,
	'spaces' => $spaces,
	'spaceList' => $spaceList));