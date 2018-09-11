<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="ccm-ui">

	<div class="bg-info" style="padding:10px; margin:20px 0px 20px 0px;">
		<?php    echo t("Please Select Show or Hide to control the appearance of Listings"); ?>
	</div>
	
	<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('listing', t('Listing')) ?>
    <?php $mySelectOptions = array('Hide','show')?>

	<?php echo $form->select('listing',  array("0" => "Hide", "1" => "Show"), $listing);?>

</div>

</div>