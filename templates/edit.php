<div class="wrap <?php echo self::$textdomain; ?>">
	<?php
		if ($post_type == 'new_custom_post_type') 
			$title  = __( 'Create Custom Post Type', self::$textdomain );
		else
			$title = __( 'Edit Custom Post Type', self::$textdomain ) . ' <b>' .$cpt['labels']['singular_name'] . '</b> <span class="will_be_deleted">(' .  __( 'will be deleted', self::$textdomain ) .')</span>';
	?>
	<h2><?php echo $title; ?></h2>
	<?php $this->notice(); ?><br>
	<form action="" method="POST" class="<?php echo self::$textdomain; ?>_form">	
		<?php wp_nonce_field( self::$textdomain . '_' . $post_type ); ?>
		<div class="<?php echo self::$textdomain; ?>_wrapper" data-post-type="<?php echo $post_type; ?>">
			<div class="<?php echo self::$textdomain; ?>_options_content">
				<div class="<?php echo self::$textdomain; ?>_wrapper_half first">
					<!-- Enabled -->
					<?php
						$field_name = self::$textdomain . '[' . $post_type . '][enabled]';
						$field_id_part = str_replace(array('[', ']'), '', $field_name);
					?>
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php $field_id = $field_id_part . 'yes'; ?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Enabled', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['enabled'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = $field_id_part . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['enabled'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Set <b>Yes</b> to enable this custom post type in your theme', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Enabled end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<h4><?php _e('Options', self::$textdomain); ?></h4>
					<!-- Post type -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][post_type]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Post Type', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['post_type']; ?>" >
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'max. 20 characters, can not contain capital letters or spaces', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Post type end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Description -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][description]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Description', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['description']; ?>" >
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'A short descriptive summary of what the post type is', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Description end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Public -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][public]';
							$field_id_part = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Public', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = $field_id_part . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['public'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = $field_id_part . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['public'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether a post type is intended to be used publicly either via the admin interface or by front-end users', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Public end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Exclude From Search -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][exclude_from_search]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Exclude From Search', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['exclude_from_search'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['exclude_from_search'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether to exclude posts with this post type from front end search results', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Exclude From Search end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Publicly Queryable -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][publicly_queryable]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Publicly Queryable', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['publicly_queryable'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['publicly_queryable'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether queries can be performed on the front end. If you set this to <b>No</b>, you will find that you cannot preview/see your custom post (return 404)', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Publicly Queryable end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Show UI -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][show_ui]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Show UI', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_ui'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_ui'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether to generate a default UI for managing this post type in the admin', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Show UI end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Show In Nav Menus -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][show_in_nav_menus]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Show In Nav Menus', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_nav_menus'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_nav_menus'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether post type is available for selection in navigation menus', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Show In Nav Menus end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Show In Menu -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][show_in_menu]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Show In Menu', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_menu'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_menu'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][show_in_sub_menu]';
								$field_id = str_replace(array('[', ']'), '_', $field_name) . 'string';
							?>
						</div>
					</div>
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<label for="<?php echo $field_id; ?>"><?php _e( 'Place as submenu', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<select name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>"  value="<?php echo $cpt['show_in_sub_menu']; ?>">
								<option value=""><?php _e( 'Do not use',  self::$textdomain ); ?></option>
								<?php
									global $menu;
									foreach ($menu as $key => $value) {
										if ($value[0] && $value[2]) { ?>
											<option <?php selected( $cpt['show_in_sub_menu'], $value[2] ); ?> value="<?php echo $value[2]; ?>"><?php echo preg_replace( '/<.*?\b[^>]*>(.*?)<\/.*?>/i', "", $value[0] ); ?></option>
										<? }
									} ?>
							</select>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Where to show the post type in the admin menu. <b>Show UI</b> must be <b>Yes</b>', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Show In Menu end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Show In Admin Bar Menus -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][show_in_admin_bar]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Show In Admin Bar', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_admin_bar'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['show_in_admin_bar'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether to make this post type available in the WordPress admin bar', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Show In Admin Bar end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Menu Position -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][menu_position]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Menu Position', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<select name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['menu_position']; ?>">
								<option value="" <?php selected($cpt['menu_position'], ''); ?>><?php _e( 'none',  self::$textdomain ); ?></option>
								<option value="5" <?php selected($cpt['menu_position'], '5'); ?>><?php _e( 'below Posts',  self::$textdomain ); ?></option>
							    <option value="10" <?php selected($cpt['menu_position'], '10'); ?>><?php _e( 'below Media',  self::$textdomain ); ?></option>
							    <option value="15" <?php selected($cpt['menu_position'], '15'); ?>><?php _e( 'below Links',  self::$textdomain ); ?></option>
							    <option value="20" <?php selected($cpt['menu_position'], '20'); ?>><?php _e( 'below Pages',  self::$textdomain ); ?></option>
							    <option value="25" <?php selected($cpt['menu_position'], '25'); ?>><?php _e( 'below comments',  self::$textdomain ); ?></option>
							    <option value="60" <?php selected($cpt['menu_position'], '60'); ?>><?php _e( 'below first separator',  self::$textdomain ); ?></option>
							    <option value="65" <?php selected($cpt['menu_position'], '65'); ?>><?php _e( 'below Plugins',  self::$textdomain ); ?></option>
							    <option value="70" <?php selected($cpt['menu_position'], '70'); ?>><?php _e( 'below Users',  self::$textdomain ); ?></option>
							    <option value="75" <?php selected($cpt['menu_position'], '75'); ?>><?php _e( 'below Tools',  self::$textdomain ); ?></option>
							    <option value="80" <?php selected($cpt['menu_position'], '80'); ?>><?php _e( 'below Settings',  self::$textdomain ); ?></option>
							    <option value="100" <?php selected($cpt['menu_position'], '100'); ?>><?php _e( 'below second separator ',  self::$textdomain ); ?></option>
							</select>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'The position in the menu order the post type should appear. <b>Show in menu</b> must be <b>Yes</b>', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Menu Position end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Menu Icon -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$menu_icons = array(
								'menu',
								'admin-site',
								'dashboard',
								'admin-post',
								'admin-media',
								'admin-links',
								'admin-page',
								'admin-comments',
								'admin-appearance',
								'admin-plugins',
								'admin-users',
								'admin-tools',
								'admin-settings',
								'admin-network',
								'admin-home',
								'admin-generic',
								'admin-collapse',
								'welcome-write-blog',
								'welcome-add-page',
								'welcome-view-site',
								'welcome-widgets-menus',
								'welcome-comments',
								'welcome-learn-more',
								'format-aside',
								'format-image',
								'format-gallery',
								'format-video',
								'format-status',
								'format-quote',
								'format-chat',
								'format-audio',
								'camera',
								'images-alt',
								'images-alt2',
								'video-alt',
								'video-alt2',
								'video-alt3',
								'image-crop',
								'image-rotate-left',
								'image-rotate-right',
								'image-flip-vertical',
								'image-flip-horizontal',
								'undo',
								'redo',
								'editor-bold',
								'editor-italic',
								'editor-ul',
								'editor-ol',
								'editor-quote',
								'editor-alignleft',
								'editor-aligncenter',
								'editor-alignright',
								'editor-insertmore',
								'editor-spellcheck',
								'editor-expand',
								'editor-kitchensink',
								'editor-underline',
								'editor-justify',
								'editor-textcolor',
								'editor-paste-word',
								'editor-paste-text',
								'editor-removeformatting',
								'editor-video',
								'editor-customchar',
								'editor-outdent',
								'editor-indent',
								'editor-help',
								'editor-strikethrough',
								'editor-unlink',
								'editor-rtl',
								'align-left',
								'align-right',
								'align-center',
								'align-none',
								'lock',
								'calendar',
								'visibility',
								'post-status',
								'edit',
								'trash',
								'arrow-up',
								'arrow-down',
								'arrow-right',
								'arrow-left',
								'arrow-up-alt',
								'arrow-down-alt',
								'arrow-right-alt',
								'arrow-left-alt',
								'arrow-up-alt2',
								'arrow-down-alt2',
								'arrow-right-alt2',
								'arrow-left-alt2',
								'sort',
								'leftright',
								'list-view',
								'exerpt-view',
								'share',
								'share-alt',
								'share-alt2',
								'twitter',
								'rss',
								'email',
								'email-alt',
								'facebook',
								'facebook-alt',
								'googleplus',
								'networking',
								'hammer',
								'art',
								'migrate',
								'performance',
								'wordpress',
								'wordpress-alt',
								'pressthis',
								'update',
								'screenoptions',
								'info',
								'cart',
								'feedback',
								'cloud',
								'translation',
								'tag',
								'category',
								'yes',
								'no',
								'no-alt',
								'plus',
								'minus',
								'dismiss',
								'marker',
								'star-filled',
								'star-half',
								'star-empty',
								'flag',
								'location',
								'location-alt',
								'vault',
								'shield',
								'shield-alt',
								'sos',
								'search',
								'slides',
								'analytics',
								'chart-pie',
								'chart-bar',
								'chart-line',
								'chart-area',
								'groups',
								'businessman',
								'id',
								'id-alt',
								'products',
								'awards',
								'forms',
								'testimonial',
								'portfolio',
								'book',
								'book-alt',
								'download',
								'upload',
								'backup',
								'clock',
								'lightbulb',
								'desktop',
								'tablet',
								'smartphone',
								'smiley'
							);
							$field_name = self::$textdomain . '[' . $post_type . '][menu_icon]';
							$field_id_part = str_replace(array('[', ']'), '_', $field_name);
							$field_id = $field_id_part . 'default_icon';
							if (!isset($cpt['menu_icon']))
								 $cpt['menu_icon'] = '';
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Menu Icon', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper icons">
							<label for="<?php echo $field_id; ?>" class="default">							
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['menu_icon'], false); ?> value="1" /> <?php _e( 'Default', self::$textdomain ); ?>
							</label>
							<br>
							<?php
								foreach ($menu_icons as $menu_icon) {
									$checked = $cpt['menu_icon'] == 'dashicons-' . $menu_icon ? 'checked="checked" ' : '' ;
									$field_id = $field_id_part . $menu_icon;
							?>
								<label for="<?php echo $field_id; ?>" class="icon16 <?php echo 'dashicons-' . $menu_icon; ?> <?php echo $checked ? 'checked' : '' ;?>">
									<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['menu_icon'], 'dashicons-' . $menu_icon ); ?> value="<?php echo 'dashicons-' . $menu_icon; ?>" />
								</label>
							<?php } ?>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'The icon to be used for this menu', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Menu Icon end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Hierarchical -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][hierarchical]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Hierarchical', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['hierarchical'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['hierarchical'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The <b>supports</b> parameter should contain <b>page-attributes</b> to show the parent select box on the editor page.', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Hierarchical end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Taxonomies -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name_part = self::$textdomain . '[' . $post_type . '][taxonomies]';
							$field_id_part = str_replace(array('[', ']'), '_', $field_name_part);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Taxonomies', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper supports">
							<?php foreach ($this->taxonomies() as $slug => $taxonomy) {
								$field_name = $field_name_part . '[' . $slug . ']';
								$field_id = $field_id_part . '_' . $slug;
								$checked = isset($cpt['taxonomies'][$slug]) && $cpt['taxonomies'][$slug] == '1' ? 'checked="checked" ' : '' ;
							?>
								<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
								<label for="<?php echo $field_id; ?>">
									<input type="checkbox" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php echo $checked; ?> value="1" /> <?php echo $taxonomy->labels->singular_name; ?>
								</label>
								<?php if ( $taxonomy->description ) { ?>
									<div class="<?php echo self::$textdomain; ?>_note"><?php echo $taxonomy->description; ?></div>
								<?php } ?>
							<?php } ?>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'An array of registered taxonomies like <b>category</b> or <b>post_tag</b> that will be used with this post type', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Taxonomies end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Has Archive -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][has_archive]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Has Archive', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['has_archive'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['has_archive'], 0); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Enables post type archives', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Has Archive end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Rewrite -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][rewrite]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Rewrite', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Triggers the handling of rewrites for this post type. To prevent rewrites, set to false', self::$textdomain ); ?></div>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][rewrite_slug]';
								$field_id = str_replace(array('[', ']'), '', $field_name);
							?>
							<label for="<?php echo $field_id; ?>"><?php _e( 'Slug', self::$textdomain ); ?></label>
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['rewrite_slug']; ?>" />
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Customize the permastruct slug. Defaults to the post type value. Should be translatable. Enter value in main language and translate other languages with <b>.po</b> files', self::$textdomain ); ?></div>
							<label for="<?php echo $field_id; ?>"><?php _e( 'With Front', self::$textdomain ); ?></label>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][rewrite_with_front]';
								$field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes';
							?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_with_front'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_with_front'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Should the permastruct be prepended with the front base. (example: if your permalink structure is <b>/blog/</b>, then your links will be: <b>false->/news/</b>, <b>true->/blog/news/</b>)', self::$textdomain ); ?></div>

							<label for="<?php echo $field_id; ?>"><?php _e( 'Feeds', self::$textdomain ); ?></label>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][rewrite_feeds]';
								$field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes';
							?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_feeds'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_feeds'], 0); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Should a feed permastruct be built for this post type', self::$textdomain ); ?></div>
							<label for="<?php echo $field_id; ?>"><?php _e( 'Pages', self::$textdomain ); ?></label>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][rewrite_pages]';
								$field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes';
							?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_pages'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['rewrite_pages'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Should the permastruct provide for pagination', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Rewrite end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Query Var -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][query_var]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Query Var', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['query_var'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['query_var'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Sets the <b>query_var</b> key for this post type', self::$textdomain ); ?></div>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][query_var_string]';
								$field_id = str_replace(array('[', ']'), '', $field_name);
							?>
							<label for="<?php echo $field_id; ?>"><?php _e( 'Parameter (optional)', self::$textdomain ); ?></label>
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['query_var_string']; ?>" />
						</div>
					</div>
					<!-- Query Var end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Can Export -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][can_export]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Can Export', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'yes'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['can_export'] ); ?> value="1" /> <?php _e('Yes', self::$textdomain); ?>
							</label>
							<?php $field_id = str_replace(array('[', ']'), '_', $field_name) . 'no'; ?>
							<label for="<?php echo $field_id; ?>">
								<input type="radio" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['can_export'], 0 ); ?> value="0" /> <?php _e('No', self::$textdomain); ?>
							</label>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Can this post type be exported', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Can Export end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Capability Type -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][capability_type]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Capability Type', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['capability_type']; ?>" />
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Capability Type parameter gives you global control over the capabilities', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Capability Type end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Capabilities -->
					<h4><?php _e( 'Capabilities', self::$textdomain ); ?></h4>
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
							<?php
							foreach ($cpt['capabilities'] as $capability_base => $capability_value) {
								$field_name = self::$textdomain . '[' . $post_type . '][capabilities][' . $capability_base . ']';
								$field_id = str_replace(array('[', ']'), '', $field_name);
							?>
							<label for="<?php echo $field_id; ?>"><?php echo ucfirst( str_replace( '_', ' ', $capability_base ) ); ?></label>
							<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper capability">
								<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $capability_value; ?>" />
							</div>
							<?php } ?>
					</div>
					<!-- Capabilities end -->
				</div>
				<div class="<?php echo self::$textdomain; ?>_wrapper_half">
					<!-- Labels -->
					<h4><?php _e('Labels', self::$textdomain); ?></h4>
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][label]';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<label for="<?php echo $field_id; ?>"><?php _e( 'Label', self::$textdomain ); ?></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo isset( $cpt['label'] ) && $cpt['label'] ? $cpt['label'] : $cpt['post_type'] ; ?>" >
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'A plural descriptive name for the post type marked for translation', self::$textdomain ); ?></div>
						</div>
					</div>
					<?php foreach ($this->labels as $name => $params) {
							$this->labels['name']['0'] = $post_type;
							$this->labels['singular_name']['0'] = $post_type;
							$this->labels['menu_name']['0'] = $post_type;
							$this->labels['name_admin_bar']['0'] = $post_type;
							$this->labels['all_items']['0'] = $post_type;
						?>
						<div class="<?php echo self::$textdomain; ?>_cpt_option <?php echo self::$textdomain; ?>_cpt_label_<?php echo $name; ?>">
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][labels][' . $name . ']';
								$field_id = str_replace(array('[', ']'), '', $field_name);
							?>
							<label for="<?php echo $field_id; ?>"><?php echo $params[1]; ?></label>
							<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
								<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['labels'][$name]; ?>" >
								<div class="<?php echo self::$textdomain; ?>_note"><?php echo $params[2]; ?></div>
							</div>
						</div>
					<?php } ?>
					<!-- Labels end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Supports -->
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php
							$supports = array(
							 	'title' => array( __( 'Title', self::$textdomain) ),
								'editor' => array( __( 'Editor', self::$textdomain), __( 'Content', self::$textdomain) ),
								'author' => array( __( 'Author', self::$textdomain) ),
								'thumbnail' => array( __( 'Thumbnail', self::$textdomain), __( 'Featured image, current theme must also support post-thumbnails', self::$textdomain) ),
								'excerpt' => array( __( 'Excerpts', self::$textdomain) ),
								'trackbacks' => array( __( 'Trackbacks', self::$textdomain) ),
								'custom-fields' => array( __( 'Custom Fields', self::$textdomain) ),
								'comments' => array( __( 'Comments', self::$textdomain), __( 'Also will see comment count balloon on edit screen', self::$textdomain) ),
								'revisions' => array( __( 'Revisions', self::$textdomain), __( 'Will store revisions', self::$textdomain) ),
								'page-attributes' => array( __( 'Page Attributes', self::$textdomain), __( 'Menu order, hierarchical must be true to show Parent option', self::$textdomain) ),
								'post-formats' => array( __( 'Post Formats', self::$textdomain), __( 'Add post formats. You can choose post formats separately to each custom post type if you install and active <b>Toolset Features</b> plugin', self::$textdomain) )
							);
							$field_name_part = self::$textdomain . '[' . $post_type . '][supports]';
							$field_id_part = str_replace(array('[', ']'), '_', $field_name_part);
						?>
						<label for="<?php echo $field_id; ?>"><b><?php _e( 'Supports', self::$textdomain ); ?></b></label>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper supports">
							<?php foreach ($supports as $support => $params) {
									if ( $support == 'post-formats' && $this->toolset_features() ) {
										continue;
									}
									$field_name = $field_name_part . '[' . $support . ']';
									$field_id = $field_id_part . '_' . $support;
							?>
								<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
								<label for="<?php echo $field_id; ?>">
									<input type="checkbox" autocomplete="off" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php checked( $cpt['supports'][$support] ); ?> value="1" /> <?php echo $params[0]; ?>
								</label>
								<?php if ( isset( $params[1] ) ) { ?>
									<div class="<?php echo self::$textdomain; ?>_note"><?php echo $params[1]; ?></div>
								<?php } ?>
							<?php } ?>
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'Features for current custom post type', self::$textdomain ); ?></div>
						</div>
					</div>
					<!-- Supports end -->
					<!-- Post Formats -->
					<?php if ($this->toolset_features()) { ?>
						<div class="<?php echo self::$textdomain; ?>_separator"></div>
						<div class="<?php echo self::$textdomain; ?>_cpt_option">
							<label><b><?php _e('Post Formats', self::$textdomain); ?></b></label>
							<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
								<?php
									$default_post_formats = $this->toolset_features->features_config()['post-formats']['options'];
									$post_formats_options = $this->toolset_features->option('post-formats');
								?>
								<div class="<?php echo self::$textdomain; ?>_post_type">
									<?php foreach($default_post_formats as $name => $title) {
										$field_name = self::$textdomain . '[' . $post_type . '][post-formats][' . $name . ']';
										$field_id = str_replace(array('[', ']'), '_', $field_name);
										$checked = isset($post_formats_options[$post_type]) && $post_formats_options[$post_type][$name] ? 'checked="checked" ' : '' ;
										?>
										<div class="<?php echo self::$textdomain; ?>_post_format">
											<input type="hidden" name="<?php echo $field_name; ?>" value="0" />
											<label for="<?php echo $field_id; ?>">
												<input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" <?php echo $checked; ?> value="1" />
												<?php echo $title; ?>
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<!-- Post Formats end -->
					<div class="<?php echo self::$textdomain; ?>_separator"></div>
					<!-- Messages -->
					<?php
						$messages = array(
							'1' => __( 'Book updated', self::$textdomain ),
							__( 'Custom field updated', self::$textdomain ),
							__( 'Custom field deleted', self::$textdomain ),
							__( 'Book updated', self::$textdomain ),
							__( 'Book restored to revision from %s', self::$textdomain ),
							__( 'Book published', self::$textdomain ),
							__( 'Book saved', self::$textdomain ),
							__( 'Book submitted', self::$textdomain ),
							__( 'Book scheduled for: <strong>%1$s</strong>.', self::$textdomain ),
							__( 'Book draft updated.', self::$textdomain )
						);
						foreach ($messages as $key => $message) {
					?>
					<div class="<?php echo self::$textdomain; ?>_cpt_option">
						<?php if ($key == 1) { ?>
							<label><b><?php _e('Messages', self::$textdomain); ?></b></label>
						<?php } ?>
						<?php
							$field_name = self::$textdomain . '[' . $post_type . '][messages][' . $key . ']';
							$field_id = str_replace(array('[', ']'), '', $field_name);
						?>
						<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper">
							<input type="text" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $cpt['messages'][$key]; ?>" >
							<div class="<?php echo self::$textdomain; ?>_note"><?php _e( 'For example:', self::$textdomain ); ?> <b><?php echo $message; ?></b></div>
						</div>
					</div>
					<?php } ?>
					<!-- Messages end -->
					</div>
					<?php if ($post_type != 'new_custom_post_type') { ?>
					<!-- Delete -->
						<div class="<?php echo self::$textdomain; ?>_cpt_option <?php echo self::$textdomain; ?>_delete">
							<div class="<?php echo self::$textdomain; ?>_separator"></div>
							<?php
								$field_name = self::$textdomain . '[' . $post_type . '][delete]';
								$field_id = str_replace(array('[', ']'), '', $field_name);
							?>
							<label for="<?php echo $field_id; ?>"><?php _e( 'Delete custom post type', self::$textdomain ); ?></label>
							<div class="<?php echo self::$textdomain; ?>_cpt_input_wrapper radio">
								<input autocomplete="off" type="hidden" name="<?php echo $field_name; ?>" value="0" />
								<label for="<?php echo $field_id; ?>">
									<input autocomplete="off" type="checkbox" autocomplete="off" class="<?php echo self::$textdomain; ?>_delete_checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="1" /> <?php _e( 'Set checked to delete this custom post type on save', self::$textdomain ); ?>
								</label>
							</div>
						</div>
					<!-- Delete end -->
					<?php } ?>
				<?php submit_button('Save Changes', 'primary clear', self::$textdomain . '[submit]'); ?>
			</div>

		</div>
	</form>
</div>

<script>
	<?php if ($this->toolset()) { ?>
		window.toolset_menu_parent_id = 'toplevel_page_toolset';
	<?php } else { ?>
		window.toolset_menu_parent_id = 'menu-settings';
	<?php } ?>
	window.toolset_menu_page_href = 'toolset-custom-post-types';
</script>