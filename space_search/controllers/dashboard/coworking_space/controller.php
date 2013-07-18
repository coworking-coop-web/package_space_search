<?php

defined("C5_EXECUTE") or die(_("Access Denied."));

class DashboardCoworkingSpaceController extends Controller {

	public function view() {
		$this->redirect('/dashboard/coworking_space/search');
	}

}