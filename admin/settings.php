<div class="wrap">
<?php
 if (isset($messages))
 foreach($messages as $message) {
?>
    <div id="message" class="<?php echo $message['type'];?>"><p><?php echo $message['text']; ?>.</p></div>
<?php	 
 }
?>

<h2>
<?php echo __('Settings','wp-calc-weight'); ?>
</h2>
<div style="float: left;">
<form name="form_settings" method="POST" action="<?php echo calc_weight_build_url(array ('page' => 'calc_weight')); ?>" enctype="multipart/form-data">
    <?php settings_fields( 'wp-calc-weight-settings-group' ); ?>
    <?php do_settings_sections( 'wp-calc-weight-settings-group' ); ?>
    <table class="form-table">

        <tr valign="top">
	        <td scope="row"><?php echo __('Shortcodes samples','wp-calc-weight');?>:</td>
	        <td>
[calc-weight]<br/>
[calc-weight age=27]<br/>
[calc-weight gender=female]<br/>
[calc-weight age=27 gender=male]<br/>
        	</td>
        </tr>
        
        <tr valign="top">
	        <td scope="row"><?php echo __('Public language','wp-calc-weight');?>:</td>
	        <td>
				<select class="form-input-tip" name="wp-calc-weight-public_locale">
					<option value="en_US" <?php echo ( ( esc_attr( 'en_US' == get_option('wp-calc-weight-public_locale') ) ) ? 'selected' : ''); ?>>English</option>
					<option value="es_ES" <?php echo ( ( esc_attr( 'es_ES' == get_option('wp-calc-weight-public_locale') ) ) ? 'selected' : ''); ?>>Español</option>
					<option value="ru_RU" <?php echo ( ( esc_attr( 'ru_RU' == get_option('wp-calc-weight-public_locale') ) ) ? 'selected' : ''); ?>>Русский</option>
    				<option value="nb_NO" <?php echo ( ( esc_attr( 'nb_NO' == get_option('wp-calc-weight-public_locale') ) ) ? 'selected' : ''); ?>>Norwegian(Bokmål)</option>
				</select>
        	</td>
        </tr>

    		<tr>
				<td><?php echo __('Measurement system','wp-calc-weight'); ?>:</td>
				<td>
					<select class="form-input-tip" name="meas_system">
						<option value="0" <?php echo ((get_option('wp-calc-weight-meas_system') == '0') ) ? 'selected' : ''; ?>><?php echo __('Metric','wp-calc-weight'); ?></option>
    					<option value="1" <?php echo ((get_option('wp-calc-weight-meas_system') == '1') ) ? 'selected' : ''; ?>><?php echo __('Imperial','wp-calc-weight'); ?></option>
					</select>
				</td>
			</tr>

    		<tr>
				<td><?php echo __('Round up calculations','wp-calc-weight'); ?>:</td>
				<td>
					<select class="form-input-tip" name="round_up_calc">
						<option value="0" <?php echo ((get_option('wp-calc-weight-round_up_calc') == '0') ) ? 'selected' : ''; ?>><?php echo __('No','wp-calc-weight'); ?></option>
    					<option value="1" <?php echo ((get_option('wp-calc-weight-round_up_calc') == '1') ) ? 'selected' : ''; ?>><?php echo __('Yes','wp-calc-weight'); ?></option>
					</select>
				</td>
			</tr>

    		<tr>
				<td><?php echo __('Custom header','wp-calc-weight'); ?>:</td>
				<td>
					<input class="form-input-tip" type="text" value="<?php echo get_option('wp-calc-weight-custom_header'); ?>" name="custom_header" />
				</td>
			</tr>

			<tr>
				<td><?php echo __('Show header','wp-calc-weight'); ?>:</td>
				<td><select class="form-input-tip" name="show_header">
						<option value="1" <?php echo (get_option('wp-calc-weight-show_header') == '1') ? 'selected' : ''; ?>><?php echo __('Yes','wp-calc-weight'); ?></option>
						<option value="0" <?php echo (get_option('wp-calc-weight-show_header') == '0') ? 'selected' : ''; ?>><?php echo __('No','wp-calc-weight'); ?></option>
					</select>
				</td>
			</tr>

    		<tr>
				<td><?php echo __("Show 'Reset' button",'wp-calc-weight'); ?>:</td>
				<td><select class="form-input-tip" name="btn_reset_display">
						<option value="initial" <?php echo ($toEdit['btn_reset_display']!='none') ? 'selected' : ''; ?>><?php echo __('Yes','wp-calc-weight'); ?></option>
						<option value="none" <?php echo ($toEdit['btn_reset_display']=='none') ? 'selected' : ''; ?>><?php echo __('No','wp-calc-weight'); ?></option>
					</select>
				</td>
			</tr>

    		<tr>
				<td colspan="2">&nbsp;</td>
			</tr>

			<tr>
				<td><?php echo __("Custom basic font size",'wp-calc-weight'); ?>:</td>
				<td><input class="form-input-tip" type="text" size="2" value="<?php echo $toEdit['basic_font_size']; ?>" name="basic_font_size" /> px</td>
			</tr>

			<tr>
				<td><?php echo __("Custom border color",'wp-calc-weight')?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['basic_border_color']; ?>" name="basic_border_color"/></td>
			</tr>

			<tr>
				<td><?php echo __("Custom name for 'Calculate' button",'wp-calc-weight'); ?>:</td>
				<td><input class="form-input-tip" type="text" value="<?php echo get_option('wp-calc-weight-btn_calc_name'); ?>" name="btn_calc_name" /></td>
			</tr>

			<tr>
				<td><?php echo __("Custom background color for 'Calculate' button",'wp-calc-weight'); ?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_calc_background']; ?>" name="btn_calc_background"/></td>
			</tr>
			<tr>
				<td><?php echo __("Custom font color for 'Calculate' button (normal and hover)",'wp-calc-weight'); ?>:</td>
				<td>
					<input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_calc_color']; ?>" name="btn_calc_color"/>
				    <input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_calc_hover_color']; ?>" name="btn_calc_hover_color"/>
				</td>
			</tr>

			<tr>
				<td><?php echo __("Custom background color for 'Reset' button",'wp-calc-weight'); ?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_reset_background']; ?>" name="btn_reset_background"/></td>
			</tr>
			<tr>
				<td><?php echo __("Custom font color for 'Reset' button (normal and hover)",'wp-calc-weight'); ?>:</td>
				<td>
					<input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_reset_color']; ?>" name="btn_reset_color"/>
				    <input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['btn_reset_hover_color']; ?>" name="btn_reset_hover_color"/>
				</td>
			</tr>


			<tr>
				<td><?php echo __("Custom background color for table header",'wp-calc-weight')?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['table_head_background']; ?>" name="table_head_background"/></td>
			</tr>
			<tr>
				<td><?php echo __("Custom font color for table header",'wp-calc-weight')?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['table_head_color']; ?>" name="table_head_color"/></td>
			</tr>


			<tr>
				<td><?php echo __("Custom border color for input",'wp-calc-weight')?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['input_border_color']; ?>" name="input_border_color"/></td>
			</tr>
			<tr>
				<td><?php echo __("Custom background color for input",'wp-calc-weight'); ?>:</td>
				<td><input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['input_background']; ?>" name="input_background"/></td>
			</tr>
			<tr>
				<td><?php echo __("Custom font color for input",'wp-calc-weight'); ?>:</td>
				<td>
					<input class="color-field form-input-tip" type="text" value="<?php echo $toEdit['input_color']; ?>" name="input_color"/>
				</td>
			</tr>

			<tr>
				<td><?php echo __("Advertising javascript (e.g. Google adsense)",'wp-calc-weight'); ?>:</td>
				<td>
					<textarea class="form-input-tip" name="advert_js" rows="10" cols="50"><?php echo get_option('wp-calc-weight-advert_js'); ?></textarea>
				</td>
			</tr>

        <tr valign="top">
	        <th scope="row"><?php echo __('PHP version','wp-calc-weight');?>:</th>
	        <td>
		        <?php echo phpversion(); ?>
        	</td>
        </tr>
       

    </table>

    <input type="submit" value="<?php echo __('Save','wp-calc-weight'); ?>" name="submit" class="button-primary"/>
    
</form></div>
</div>