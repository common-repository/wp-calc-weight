<div class="wp-calc-weight" id="wp_calc_weight_<?php echo $calc_weight_front_idx;?>">

<input type="hidden" class="round_up_calc" value="<?php echo $calculator['round_up_calc'] ?>"/>
<input type="hidden" class="meas_system" value="<?php echo $calculator['meas_system'] ?>"/>

<input type="hidden" class="textFormula" value="<?php echo __('Formula', 'wp-calc-weight');?>"/>
<input type="hidden" class="textIdealWeight" value="<?php echo __('Ideal weight', 'wp-calc-weight');?>"/>
<input type="hidden" class="textWeightUnit" value="<?php echo $calculator['meas_system']=='0'?__('kg.', 'wp-calc-weight'):__('lbs.', 'wp-calc-weight');?>"/>

<input type="hidden" class="textFormulaRobinson" value="<?php echo __("Robinson's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaMiller" value="<?php echo __("Miller's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaDevine" value="<?php echo __("Devine's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaHamwi" value="<?php echo __("Hamwi formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaCreff" value="<?php echo __("Creff's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaNagler" value="<?php echo __("Nagler's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaCooper" value="<?php echo __("Cooper's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaMonnerotDumaine" value="<?php echo __("Monnerot-Dumaine's formula", 'wp-calc-weight');?>"/>
<input type="hidden" class="textFormulaBMI" value="<?php echo __('World Health Organization recommendation(BMI: 18.5 - 25)', 'wp-calc-weight');?>"/>

<?php 
	if ($show_header) {
?>
<h3><?php echo __($title_label, 'wp-calc-weight');?></h3>
<?php
	}
?>

<form name="idealweight_<?php echo $calc_weight_front_idx;?>">

<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-6"><?php echo __('Age', 'wp-calc-weight');?></div>
<div class="wp-calc-weight-col-6"><input class="age" type="text" value="<?php echo $age;?>"/> <?php echo __('years', 'wp-calc-weight');?></div>
</div>
<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-6"><?php echo __('Gender', 'wp-calc-weight');?></div>
<div class="wp-calc-weight-col-6">
<select class="gender"/>
	<option value="male" <?php echo $gender=='male'?'selected':'';?>><?php echo __('Male', 'wp-calc-weight');?></option>
	<option value="female" <?php echo $gender=='female'?'selected':'';?>><?php echo __('Female', 'wp-calc-weight');?></option>
</select>
</div>
</div>
<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-6"><?php echo __('Height', 'wp-calc-weight');?></div>
<div class="wp-calc-weight-col-4"><input type="text" class="height" value="<?php echo $height;?>" style="width: 70px;" /> <?php echo $calculator['meas_system']=='0'?__('cm', 'wp-calc-weight'):__('ft', 'wp-calc-weight');?>
<?php if ($calculator['meas_system']=='1') { ?>
<input type="text" class="height2" style="width: 70px; margin-left: 10px;"/>
<?php echo __('inch', 'wp-calc-weight');?>
<?php } ?>
</div>
<div class="wp-calc-weight-col-2">

</div>
</div>

<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-6"><?php echo __('Girth of wrist', 'wp-calc-weight');?></div>
<div class="wp-calc-weight-col-6"><input class="wrist" type="text" style="width: 70px;"/> <?php echo $calculator['meas_system']=='0'?__('cm', 'wp-calc-weight'):__('inch', 'wp-calc-weight');?></div>
</div>

<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-12">
	<center>
		<input type="button" value="<?php echo $btn_calc_name; ?>" onclick="calc_idealweight('wp_calc_weight_<?php echo $calc_weight_front_idx;?>');" class="calc_weight_button" />
		<input type="reset" value="<?php echo __('Reset','wp-calc-weight'); ?>" onclick="jQuery('#wp_calc_weight_<?php echo $calc_weight_front_idx;?> .resmore').html(''); return true;" class="calc_weight_reset_button" />
	</center>
</div>
</div>

<?php
	if (!empty($calculator['advert_js'])) {
?>
<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-12 advert-js">
	<?php echo $calculator['advert_js']; ?>
</div>
</div>
<?php
	}
?>


<div class="wp-calc-weight-col">
<div class="wp-calc-weight-col-12"><span class="resmore"></span></div>
</div>
</form>
</div>