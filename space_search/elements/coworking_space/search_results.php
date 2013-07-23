<?php	defined('C5_EXECUTE') or die("Access Denied."); ?> 
<div id="ccm-coworking-space-search-results" class="ccm-page-list">
	<div class="ccm-pane-body">
	<?php if (count($spaces) > 0) { ?>
		<table border="0" cellspacing="0" cellpadding="0" class="ccm-results-list">
			<tr class="ccm-results-list-header">
				<th><?php echo t('Space Name')?></th>
				<th><?php echo t('Prefecture')?></th>
				<th><?php echo t('Coop Member?')?></th>
				<th><?php echo t('Visa Member?')?></th>
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
	<?php } else { ?>
		<div id="ccm-list-none"><?php echo t('No Spaces Found.') ?></div>
	<?php } ?>
	</div>
	<div class="ccm-pane-footer">
		<?php if(is_object($spaceList)) $spaceList->displayPagingV2($urlSearchAction,false); ?>
	</div>
</div>