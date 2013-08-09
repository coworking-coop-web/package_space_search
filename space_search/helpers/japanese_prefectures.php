<?php	
defined('C5_EXECUTE') or die("Access Denied.");
class JapanesePrefecturesHelper {
	
	private $prefectures = array(
		"01" => "北海道", "02" => "青森県", "03" => "岩手県", "04" => "宮城県", "05" => "秋田県",
		"06" => "山形県", "07" => "福島県", "08" => "茨城県", "09" => "栃木県", "10" => "群馬県",
		"11" => "埼玉県", "12" => "千葉県", "13" => "東京都", "14" => "神奈川県", "15" => "新潟県",
		"16" => "富山県", "17" => "石川県", "18" => "福井県", "19" => "山梨県", "20" => "長野県",
		"21" => "岐阜県", "22" => "静岡県", "23" => "愛知県", "24" => "三重県", "25" => "滋賀県",
		"26" => "京都府", "27" => "大阪府", "28" => "兵庫県", "29" => "奈良県", "30" => "和歌山県",
		"31" => "鳥取県", "32" => "島根県", "33" => "岡山県", "34" => "広島県", "35" => "山口県",
		"36" => "徳島県", "37" => "香川県", "38" => "愛媛県", "39" => "高知県", "40" => "福岡県",
		"41" => "佐賀県", "42" => "長崎県", "43" => "熊本県", "44" => "大分県", "45" => "宮崎県",
		"46" => "鹿児島県", "47" => "沖縄県", "99" => "海外");
 
	private $wards = array(
		13101 => '千代田区', 13102 => '中央区', 13103 => '港区', 13104 => '新宿区', 13105 => '文京区',
		13106 => '台東区', 13107 => '墨田区', 13108 => '江東区', 13109 => '品川区', 13110 => '目黒区',
		13111 => '大田区', 13112 => '世田谷区', 13113 => '渋谷区', 13114 => '中野区', 13115 => '杉並区',
		13116 => '豊島区', 13117 => '北区', 13118 => '荒川区', 13119 => '板橋区', 13120 => '練馬区',
		13121 => '足立区', 13122 => '葛飾区', 13123 => '江戸川区', 0 => 'その他');
	
	public function getPrefecturesList() {
		$select = array( "" => "選択してください" );
		$prefectures = $select + $this->prefectures;
		return $prefectures;
	}
	
	public function getWardsList() {
		$select = array( "" => "選択してください" );
		$wards = $select + $this->wards;
		return $wards;
	}

	public function getPrefectureName($val) {
		return $this->prefectures[$val];
	}

	public function getWardName($val) {
		return $this->wards[$val];
	}
}

?>