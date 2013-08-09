<?php
defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="ccm-ui">
     
<div class="control-group">
     <label class="control-label"><?php echo t('Only Visa Spaces?'); ?></label>
     <div class="controls">
          <?php echo $form->checkbox('visaOnly', 1, $visaOnly); ?>
     </div>
</div>

</div>

