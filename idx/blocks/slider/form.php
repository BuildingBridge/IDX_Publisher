<?php    
defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="col-lg-12 text-center">

	<img src="https://idxbroker.com/images/brands/idx.png" class="img-responsive">

</div>

<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('slider', t('slider')) ?>

 
	<?php echo $form->select('slider', array("0" => "Hide", "1" => "Show"), $slider);?>

</div>


<div class="form-group">
	<?php   $form = Loader::helper("form"); ?>

	<?php    echo $form->label('Number Of Blocks', t('Blocks')) ?>

 
	<?php echo $form->select('blocks', array("1" => "1", "2" => "2", "3" => "3","4" => "4"), $blocks);?>

</div>

