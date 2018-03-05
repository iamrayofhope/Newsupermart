<div id="fl-uabb-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'General Settings', 'uabb' ); ?></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<?php

				$uabb                = BB_Ultimate_Addon_Helper::get_builder_uabb();
				$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
				$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

				$is_load_templates = $is_load_panels = $uabb_live_preview = '';
				if( is_array($uabb) ) {
					$is_load_panels      = ( array_key_exists( 'load_panels', $uabb ) && $uabb['load_panels'] == 1 )  ? ' checked' : '';
					$uabb_live_preview   = ( array_key_exists( 'uabb-live-preview', $uabb ) && $uabb['uabb-live-preview'] == 1 )  ? ' checked' : '';
				} ?>

			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h4><?php _e( 'Enable UI Design', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php _e('Enable this setting for applying UI effects such as - Section panel, Search box etc. to frontend page builder. ', 'uabb'); ?>
					<?php
					if( empty( $branding_name ) && empty( $branding_short_name ) ) :
						_e('Read ', 'uabb'); ?><a target="_blank" href="https://www.ultimatebeaver.com/docs/how-to-enable-disable-beaver-builders-ui/"><?php _e('this article', 'uabb'); ?></a><?php _e(' for more information.', 'uabb');
					endif;
					?>
				</p>
				<label>					
					<input type="checkbox" class="uabb-enabled-panels" name="uabb-enabled-panels" value="" <?php echo $is_load_panels; ?> ><?php _e( 'Enable UI Design', 'uabb' ); ?>
				</label>
			</div>

			<!-- Load Panels -->
			<div class="uabb-form-setting">
				<h4><?php _e( 'Enable Live Preview', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php _e('Enable this setting to see live preview of a page without leaving the editor.', 'uabb'); ?></p>
				<label>					
					<input type="checkbox" class="uabb-live-preview" name="uabb-live-preview" value="" <?php echo $uabb_live_preview; ?> ><?php _e( 'Enable Live Preview', 'uabb' ); ?>
				</label>
			</div>
		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
		</p>

		<?php wp_nonce_field('uabb', 'fl-uabb-nonce'); ?>

	</form>
</div>