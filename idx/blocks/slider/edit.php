<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="ccm-ui">

	<div class="bg-info" style="padding:10px; margin:20px 0px 20px 0px;">
		<?php    echo t("Visibility and number of blocks in slider"); ?>
	</div>
	
	<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('Slider', t('Slider')) ?>
    
	<?php echo $form->select('slider',  array("0" => "Hide", "1" => "Show"), $slider);?>

</div>
<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('Number Of Blocks', t('Blocks')) ?>

 
	<?php echo $form->select('blocks', array("1" => "1", "2" => "2", "3" => "3","4" => "4"), $blocks);?>

</div>

</div>