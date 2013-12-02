<?php
defined('C5_EXECUTE') or die("Access Denied.");
/**
 * @package SpaceSearch
 *
 */
class CoworkingSpace extends Object {
	
	public function delete() {
		$db = Loader::db();
		$db->Execute('delete from CoworkingSpace where csID = ?', array($this->csID));
	}
	
	public function save($data) {
		$db = Loader::db();
		$vals = array(
			$data['spaceName'],
			$data['prefecture'],
			$data['ward'],
			$data['address'],
			$data['url'],
			$data['email'],
			$data['tel'],
			$data['facebook'],
			$data['coop'],
			$data['visa'],
			$this->csID
		);
		$res = $db->query("update CoworkingSpace set spaceName = ?, prefecture = ?, ward = ?, address = ?, url = ?, email = ?, tel = ?, facebook = ?, coop = ?, visa = ? where csID = ?", $vals);
		
		return $res;
	}
	
	/**
	 * @param array $data
	 * @return CoworkingSpace
	 */
	public function add($data) {
		$db = Loader::db();
		$vals = array(
			$data['spaceName'],
			$data['prefecture'],
			$data['ward'],
			$data['address'],
			$data['url'],
			$data['email'],
			$data['tel'],
			$data['facebook'],
			$data['coop'],
			$data['visa']
		);
		$db->query("insert into CoworkingSpace (spaceName, prefecture, ward, address, url, email, tel, facebook, coop, visa) values (?,?,?,?,?,?,?,?,?,?)", $vals);
		$csID = $db->Insert_ID();
		
		// return the new coworking space data
		return self::getByID($csID);
	}
	
	/**
	 * returns the CoworkingSpace object by csID
	 * @param int $csID
	 * @return CoworkingSpace
	 */
	public static function getByID($csID) {
		$db = Loader::db();
		$r = $db->GetRow('select * from CoworkingSpace where csID = ?', array($csID));
		if ($r['spaceName']) {
			$cs = new CoworkingSpace();
			$cs->setPropertiesFromArray($r);
			return (is_a($cs, "CoworkingSpace")) ? $cs : false;
		}
	}
	
}