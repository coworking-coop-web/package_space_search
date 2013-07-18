<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');

$icon_coop_src = Loader::helper('concrete/urls')->getBlockTypeAssetsURL(BlockType::getByID($this->getBlockObject()->getBlockTypeID()), 'images/icon_coop.png');
$icon_visa_src = Loader::helper('concrete/urls')->getBlockTypeAssetsURL(BlockType::getByID($this->getBlockObject()->getBlockTypeID()), 'images/icon_visa.png');
?>
<h1 class="pagetitle"><?php if ($filterByVisa != 1){ ?>コワーキングスペース検索<?php } else { ?>visa.jp検索<?php } ?><small></small></h1>

<section class="mod_pagecontents_sec marginBS ex_clearfix">
<h1 class="sectitle"><?php if ($filterByVisa != 1){ ?>コワーキングスペースを検索<?php } else { ?>コワーキングvisa.jpが利用できるスペースを探そう<?php } ?></h1>
<!--mod_pagecontents_sec_end--></section>
<?php
$this->inc('search_form.php');

if($spaces){
?>
<section class="mod_pagecontents_sec ex_clearfix">
<h1 class="sectitle">検索結果</h1>
<div class="mod_pagecontents_sec_box">
<div class="mod_spacelist">
	<?php
	foreach($spaces as $space) {
		?>
		<section class="mod_spacelist_entry">
		<h1><?php echo $th->entities($space->spaceName); ?></h1>
		<div class="mod_spacelist_entry_memo">
		<dl>
		<?php if ($space->address != '') { ?>
		<dt>所在地</dt>
		<dd><?php echo $th->entities($space->address); ?></dd>
		<?php } ?>
		<?php if ($space->url != '') { ?>
		<dt>URL</dt>
		<dd><a href="<?php echo $th->entities($space->url); ?>" target="_blank"><?php echo $th->entities($space->url); ?></a></dd>
		<?php } ?>
		<?php if ($space->email != '') { ?>
		<dt>Mail</dt>
		<dd><a href="mailto:<?php echo $th->entities($space->email); ?>"><?php echo $th->entities($space->email); ?></a></dd>
		<?php } ?>
		<?php if ($space->tel != '') { ?>
		<dt>TEL</dt>
		<dd><?php echo $th->entities($space->tel); ?></dd>
		<?php } ?>
		</dl>
		<!--mod_spacelist_entry_memo_end--></div>
		<?php if ($space->coop == 1 || $space->visa == 1) { ?>
		<ul>
		<?php if ($space->coop == 1) { ?><li><img src="<?php echo $icon_coop_src;?>" width="32" height="36" alt="コワーキング協同組合加盟"></li><?php } ?>
		<?php if ($space->visa == 1) { ?><li><img src="<?php echo $icon_visa_src;?>" width="38" height="36" alt="コワーキングvisa.jp加盟"></li><?php } ?>
		</ul>
		<?php } ?>
		<?php if ($space->visa == 1) { ?>
		<p class="vasalink ex_opaity"><a href="<?php echo View::url('/visa/visauseform/'); ?>">コワーキングvisa.jpを利用する</a></p>
		<?php } ?>
		<!--mod_spacelist_entry_end--></section>
		<?php
		// var_dump($space);
	};
	?>
<?php if(is_object($spaceList)) $spaceList->displayPaging(); ?>
<!--mod_spacelist_end--></div>
<!--mod_pagecontents_sec_box_end--></div>
<!--mod_pagecontents_sec_end--></section>
<?php
}