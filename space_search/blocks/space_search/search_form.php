<?php
defined("C5_EXECUTE") or die(_("Access Denied."));
$form = Loader::helper('form');
$ph = Loader::helper('japanese_prefectures','space_search');
$c = Page::getCurrentPage();
$actionURL = $c->getCollectionPath();
?>
<form method="post" action="<?php	echo $this->url($actionURL)?>" method="post">
	<table class="formBlockSurveyTable">
		<tbody>
			<tr>
				<td class="question">エリアから選択</td>
				<td>
					<?php	echo $form->select('prefecture', $ph->getPrefecturesList(), $_REQUEST['prefecture']); ?>
				</td>
			</tr>
			<tr>
				<td class="question">東京23区から選択</td>
				<td>
					<?php	echo $form->select('ward', $ph->getWardsList(), $_REQUEST['ward']); ?>
				</td>
			</tr>
			<tr>
				<td class="question">コワーキングスペース名で検索</td>
				<td>
					<?php	echo $form->text('spaceName', $_REQUEST['spaceName']); ?>
				</td>
			</tr>
			<?php if ($filterByVisa != 1){ ?>
			<tr>
				<td class="question">コワーキングvisa.jp</td>
				<td>
					<div class="checkboxList"><?php	echo $form->checkbox('visa', 1, $_REQUEST['visa']); ?> コワーキングvisa.jpが利用できるスペース</div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<?php	echo $form->submit('ccm-search-spaces', t('Search'), array('class' => 'formBlockSubmitButton ccm-input-button')); ?>
				</td>
			</tr>
		</tbody>
	</table>
</form>