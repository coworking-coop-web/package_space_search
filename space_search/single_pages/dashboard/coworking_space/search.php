<?php
defined("C5_EXECUTE") or die(_("Access Denied."));

/**
 * Add Form
 */
if ($this->controller->getTask() == 'add' || $this->controller->getTask() == 'submit_add') {
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add Space'), false, 'span10 offset1', false); ?>

<form method="post"  action="<?php	echo $this->action('submit_add')?>" method="post" class="form-horizontal">
<?php	echo Loader::helper('validation/token')->output('submit_add')?>
<div class="ccm-pane-body">
	<fieldset>
		<div class="control-group">
			<?php echo $form->label('spaceName', t('Space Name'))?>
			<div class="controls">
				<?php echo $form->text('spaceName', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('prefecture', t('Prefecture'))?>
			<div class="controls">
				<?php echo $form->select('prefecture', $ph->getPrefecturesList()); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('ward', t('Ward'))?>
			<div class="controls">
				<?php echo $form->select('ward', $ph->getWardsList()); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('address', t('Address'))?>
			<div class="controls">
				<?php echo $form->text('address', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('url', t('URL'))?>
			<div class="controls">
				<?php echo $form->text('url', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('facebook', t('Facebook'))?>
			<div class="controls">
				<?php echo $form->text('facebook', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('email', t('E-mail'))?>
			<div class="controls">
				<?php echo $form->text('email', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('tel', t('TEL'))?>
			<div class="controls">
				<?php echo $form->text('tel', '', array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('coop', t('Coop Member?'))?>
			<div class="controls">
				<?php echo $form->checkbox('coop', 1, false); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('visa', t('Visa Member?'))?>
			<div class="controls">
				<?php echo $form->checkbox('visa', 1, false); ?>
			</div>
		</div>
	</fieldset>
</div>
<div class="ccm-pane-footer">
	<a href="<?php	echo $this->url('/dashboard/coworking_space/search')?>" class="btn"><?php	echo t("Cancel")?></a>
	<input type="submit" name="submit" value="<?php	echo t('Save')?>" class="ccm-button-right primary btn" />
</div>
</form>

<?php

/**
 * Edit Form
 */
} elseif ($this->controller->getTask() == 'edit' || $this->controller->getTask() == 'save') {
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Edit Space'), false, 'span10 offset1', false); ?>

<form method="post"  action="<?php	echo $this->action('save')?>" method="post" class="form-horizontal">
<?php	echo Loader::helper('validation/token')->output('save')?>
<input type="hidden" name="csID" value="<?php	echo intval($csID)?>" />
<div class="ccm-pane-body">
	<fieldset>
		<div class="control-group">
			<?php echo $form->label('spaceName', t('Space Name'))?>
			<div class="controls">
				<?php echo $form->text('spaceName', $cs->spaceName, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('prefecture', t('Prefecture'))?>
			<div class="controls">
				<?php echo $form->select('prefecture', $ph->getPrefecturesList(), $cs->prefecture); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('ward', t('Ward'))?>
			<div class="controls">
				<?php echo $form->select('ward', $ph->getWardsList(), $cs->ward); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('address', t('Address'))?>
			<div class="controls">
				<?php echo $form->text('address', $cs->address, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('url', t('URL'))?>
			<div class="controls">
				<?php echo $form->text('url', $cs->url, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('facebook', t('Facebook'))?>
			<div class="controls">
				<?php echo $form->text('facebook', $cs->facebook, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('email', t('E-mail'))?>
			<div class="controls">
				<?php echo $form->text('email', $cs->email, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('tel', t('TEL'))?>
			<div class="controls">
				<?php echo $form->text('tel', $cs->tel, array('class' => 'input-xlarge')); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('coop', t('Coop Member?'))?>
			<div class="controls">
				<?php echo $form->checkbox('coop', 1, $cs->coop); ?>
			</div>
		</div>
		<div class="control-group">
			<?php echo $form->label('visa', t('Visa Member?'))?>
			<div class="controls">
				<?php echo $form->checkbox('visa', 1, $cs->visa); ?>
			</div>
		</div>
	</fieldset>
</div>
<div class="ccm-pane-footer">
	<a href="<?php	echo $this->url('/dashboard/coworking_space/search', 'view_detail', $csID)?>" class="btn"><?php	echo t("Cancel")?></a>
	<input type="submit" name="submit" value="<?php	echo t('Save')?>" class="ccm-button-right primary btn" />
</div>
</form>

<?php

/**
 * Coworking Space Detail
 */
} elseif ($this->controller->getTask() == 'view_detail') {
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Coworking Space Detail'), false, 'span10 offset1', false); ?>

<div class="ccm-pane-body">
	<dl>
		<dt><?php echo t('Space Name'); ?></dt>
		<dd><?php echo $th->entities($cs->spaceName); ?></dd>
		<dt><?php echo t('Prefecture'); ?></dt>
		<dd><?php echo $ph->getPrefectureName($cs->prefecture); ?></dd>
		<dt><?php echo t('Ward'); ?></dt>
		<dd><?php echo $ph->getWardName($cs->ward); ?></dd>
		<dt><?php echo t('Address'); ?></dt>
		<dd><?php echo $th->entities($cs->address); ?></dd>
		<dt><?php echo t('URL'); ?></dt>
		<dd><?php echo $th->entities($cs->url); ?></dd>
		<dt><?php echo t('Facebook'); ?></dt>
		<dd><?php echo $th->entities($cs->facebook); ?></dd>
		<dt><?php echo t('E-mail'); ?></dt>
		<dd><?php echo $th->entities($cs->email); ?></dd>
		<dt><?php echo t('TEL'); ?></dt>
		<dd><?php echo $th->entities($cs->tel); ?></dd>
		<dt><?php echo t('Coop Member?'); ?></dt>
		<dd><?php echo ($cs->coop) ? t('Yes') : t('No'); ?></dd>
		<dt><?php echo t('Visa Member?'); ?></dt>
		<dd><?php echo ($cs->visa) ? t('Yes') : t('No'); ?></dd>
	</dl>
</div>
<div class="ccm-pane-footer">
	<a href="<?php	echo $this->url('/dashboard/coworking_space/search')?>" class="btn"><?php	echo t("Return")?></a>
	<a href="<?php	echo $this->url('/dashboard/coworking_space/search', 'edit', $cs->csID)?>" class="btn ccm-button-right btn-primary"><?php	echo t("Edit")?></a>
	<?php $valt = Loader::helper('validation/token');?>
	<script type="text/javascript">
		deleteSpace = function() {
			if (confirm('<?php echo t('Are you sure you want to delete?')?>')) { 
				location.href = "<?php	echo  $this->url('/dashboard/coworking_space/search/', 'delete', intval($cs->csID), $valt->generate('delete')) ?>";				
			}
		}
	</script>
	<?php
		$ih = Loader::helper('concrete/interface');
		echo $ih->button_js(t('Delete'), 'deleteSpace()','right','error');
	?>
</div>

<?php

/**
 * Coworking Space List
 */
} else {
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Coworking Spaces'), false, false, false); ?>

<div class="ccm-pane-options">
	<?php
	Loader::packageElement('coworking_space/search_form', 'space_search', array(
	'form' => $form,
	'ph' => $ph,
	'urlSearchAction' => $urlSearchAction));
	?>
</div>

<?php
Loader::packageElement(
	'coworking_space/search_results', 'space_search', array(
	'th' => $th,
	'ph' => $ph,
	'urlSearchAction' => $urlSearchAction,
	'spaces' => $spaces,
	'spaceList' => $spaceList));
?>
		
<?php
}

echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();
