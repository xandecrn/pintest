<?php get_template_part('pbpanel/header'); ?>

<div class="pbpanel-column">
	<?php if (isset($_POST["update_options"])) { ?>
		<?php
			foreach ($_POST as $key => $value) {
                if ($key != 'update_options') {
					update_option($key, esc_html($value));
				}
            }
		?>
		<div class="pbpanel-box pbpanel-updated"><?php echo __('Settings saved', 'pbpanel'); ?></div>		
	<?php } ?>
	<div class="pbpanel-box">
		<h2><?php echo __('Google Adsense', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label for="pbpanel_banner_position_1"><?php echo __('Banner Position 1', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Put your google adsense code here. Recommended banner sizes: 970x90px, 970x250px', 'pbpanel'); ?></span>
			<textarea name="pbpanel_banner_position_1" id="pbpanel_banner_position_1"><?php echo stripslashes_deep(get_option('pbpanel_banner_position_1')); ?></textarea>
		</p>
		<p>
			<label for="pbpanel_banner_position_2"><?php echo __('Banner Position 2', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Put your google adsense code here. Recommended banner sizes: 468x60px, 468x15px', 'pbpanel'); ?></span>
			<textarea name="pbpanel_banner_position_2" id="pbpanel_banner_position_2"><?php echo stripslashes_deep(get_option('pbpanel_banner_position_2')); ?></textarea>
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>