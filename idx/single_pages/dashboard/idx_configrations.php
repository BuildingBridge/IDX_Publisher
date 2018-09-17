<?php  defined('C5_EXECUTE') or die('Access Denied.') ?>
<div class="ccm-dashboard-header-buttons"></div>

<?php if(!empty($results)){
	
	?>
      <?php echo '<a class="btn btn-info" href="'.View::url('dashboard/idx_configrations/addKey/').'">'.t('Add Key').'</a>';?>
</br>
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Key</th>
      <th scope="col" colspan="3">Action</th>
    </tr>
  </thead>
  <tbody>
  
  
  <?php
	$i=1;
	while ($row = $results->FetchRow()) { ?>
  
  <tr>
     <td><?php echo $i; ?></td>
     <td><?php echo $row['key']; ?></td>
     <td><?php echo '<a class="btn btn-info btn-sm" href="'.View::url('dashboard/idx_configrations/selectKey/',$row['bID'],$row['key']).'">'.t('Select').'</a>';?></td>
      <td><?php echo '<a class="btn btn-warning btn-sm" href="'.View::url('dashboard/idx_configrations/editKey/',$row['bID'],$row['key']).'">'.t('Edit').'</a>';?></td>
       <td><?php echo '<a class="btn btn-danger btn-sm" href="'.View::url('dashboard/idx_configrations/deleteKey/',$row['bID'],$row['key']).'">'.t('Delete').'</a>';?></td>
 </tr>    
 
<?php
$i++;
}

?>
</tbody>
  </table>
  
<?php
} ?>

<?php

if(!empty($form_status)){?>
<form method="post" action="<?php echo  $this->action('insert') ?>" class="ccm-dashboard-content-form">
 <fieldset>
    <div class="form-group">
        <label for="key" class="launch-tooltip control-label" data-placement="right" title="<?=t('-M01XNFJLFa-BneZ^^^_^^')?>"><?=t('IDX KEY')?></label>
        <?=$form->text('key', $site, array('class' => 'span4'))?>
    </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <button class="pull-right btn btn-success" type="submit" ><?=t('Save')?></button>
    </div>
    </div>
    
 </form>
 <?php } 
 if(!empty($edit_form)){?>
<form method="post" action="<?php echo  $this->action('update_record') ?>" class="ccm-dashboard-content-form">
 <fieldset>
    <div class="form-group">
        <label for="key" class="launch-tooltip control-label" data-placement="right" title="<?=t('-M01XNFJLFa-BneZ^^^_^^')?>"><?=t('IDX KEY')?></label>
        <?=$form->text('key', $site, array('class' => 'span4'))?>
    </div>
    </fieldset>
    <input type="hidden" name="bID" value="<?php echo $bID;?>"
    <div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <button class="pull-right btn btn-success" type="submit" ><?=t('Update')?></button>
    </div>
    </div>
    
 </form>
 <?php } ?>
 
