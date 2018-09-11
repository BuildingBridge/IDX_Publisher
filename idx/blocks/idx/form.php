<?php    
defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="col-lg-12 text-center">

	<img src="https://idxbroker.com/images/brands/idx.png" class="img-responsive">

</div>

<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('listing', t('Listing')) ?>
    <?php $mySelectOptions = array('Hide','show')?>

	<?php echo $form->select('listing', array("0" => "Hide", "1" => "Show"), $listing);?>

</div>

