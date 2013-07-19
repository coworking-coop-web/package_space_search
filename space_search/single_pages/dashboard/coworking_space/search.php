<?php
defined("C5_EXECUTE") or die(_("Access Denied."));
$th = Loader::helper('text');
$ph = Loader::helper('japanese_prefectures','space_search');

/**
 * Add Form
 */
if ($this->controller->getTask() == 'add') {
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
 * Edit
 */
} elseif ($this->controller->getTask() == 'edit') {
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
 * Detail
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
 * List
 */
} else {
echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Coworking Spaces'), false, false, false); ?>

<div class="ccm-pane-options">
	<form method="post" action="<?php	echo $this->action('view')?>" method="post" class="form-inline">
		<fieldset>
			<?php	echo $form->text('spaceName', $_REQUEST['spaceName'], array('placeholder' => t('Space Name'), 'class' => 'input-medium')); ?>
			<?php	echo $form->select('prefecture', $ph->getPrefecturesList(), $_REQUEST['prefecture'], array('class' => 'input-medium')); ?>
			<?php	echo $form->select('ward', $ph->getWardsList(), $_REQUEST['ward'], array('class' => 'input-medium')); ?>
			<?php	echo $form->label('visa', t('Visa Member?'))?>
			<?php	echo $form->checkbox('visa', 1, $_REQUEST['visa']); ?>
			<?php	echo $form->submit('ccm-search-spaces', t('Search')); ?>
			<a href="<?php	echo View::url('/dashboard/coworking_space/search', 'add')?>" class="btn primary ccm-button-right"><?php	echo t("Add Space")?></a>
		</fieldset>
	</form>
</div>

<div class="ccm-page-list">
	<div class="ccm-pane-body">
		<table border="0" cellspacing="0" cellpadding="0" class="ccm-results-list">
			<tr class="ccm-results-list-header">
				<th><?php echo t('Space Name')?></th>
				<th><?php echo t('Prefecture')?></th>
				<th><?php echo t('Coop Member?')?></th>
				<th><?php echo t('Visa Memner?')?></th>
			</tr>
			<?php
			foreach($spaces as $space) {
				if (!isset($striped) || $striped == 'ccm-list-record-alt') {
					$striped = '';
				} else if ($striped == '') { 
					$striped = 'ccm-list-record-alt';
				}
				?>
				<tr class="ccm-list-record <?php	echo $striped?>">
					<td><a href="<?php	echo View::url('/dashboard/coworking_space/search', 'view_detail', $space->csID)?>"><?php echo $th->entities($space->spaceName); ?></a></td>
					<td><?php echo $ph->getPrefectureName($space->prefecture); ?></td>
					<td><?php echo ($space->coop) ? t('Yes') : t('No'); ?></td>
					<td><?php echo ($space->visa) ? t('Yes') : t('No'); ?></td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<div class="ccm-pane-footer">
		<?php if(is_object($spaceList)) $spaceList->displayPagingV2(); ?>
	</div>
</div>
		
<?php
}

echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();
