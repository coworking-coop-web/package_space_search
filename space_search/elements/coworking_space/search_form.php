<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<form method="get" id="ccm-coworking-space-advanced-search" action="<?php echo $urlSearchAction;?>" method="post" class="form-inline">
	<fieldset>
		<?php	echo $form->text('spaceName', $_REQUEST['spaceName'], array('placeholder' => t('Space Name'), 'class' => 'input-medium')); ?>
		<?php	echo $form->select('prefecture', $ph->getPrefecturesList(), $_REQUEST['prefecture'], array('class' => 'input-medium')); ?>
		<?php	echo $form->select('ward', $ph->getWardsList(), $_REQUEST['ward'], array('class' => 'input-medium')); ?>
		<?php	echo $form->label('visa', t('Visa Member?'))?>
		<?php	echo $form->checkbox('visa', 1, $_REQUEST['visa']); ?>
		<?php	echo $form->submit('ccm-coworking-space-search-fields-submit', t('Search')); ?>
		<a href="<?php	echo View::url('/dashboard/coworking_space/search', 'add')?>" class="btn primary ccm-button-right"><?php	echo t("Add Space")?></a>
	</fieldset>
</form>