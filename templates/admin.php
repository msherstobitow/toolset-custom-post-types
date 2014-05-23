<div class="wrap <?php echo self::$textdomain; ?>">
	<h2><?php _e( 'Custom Post Types', self::$textdomain ); ?> <a class="add-new-h2" href="<?php echo admin_url(); ?>admin.php?page=toolset-custom-post-types-edit">Add New</a></h2>	
	<?php if ( count( $this->option() ) ) { ?>
		<table class="wp-list-table widefat fixed pages <?php echo self::$textdomain; ?>_table">
			<thead>
				<tr>
					<th>																	
						<span><?php _e( 'Post Type', self::$textdomain ); ?></span>								
					</th>
					<th>
						<span><?php _e( 'Description', self::$textdomain ); ?></span>					
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>
						<span><?php _e( 'Post Type', self::$textdomain ); ?></span>
					</th>
					<th>
						<span><?php _e( 'Description', self::$textdomain ); ?></span>
					</th>	
				</tr>
			</tfoot>
			<tbody>
				<?php
					foreach ($this->option() as $post_type => $cpt) { 
						$edit_link = admin_url() . 'admin.php?page=toolset-custom-post-types-edit&amp;post-type=' . $cpt['post_type'];
				?>
					<tr class="type-page status-publish hentry iedit author-self level-0 <?php echo $cpt['enabled'] ? 'active': '';?>">
						<td class="post-title first">
							<strong>
								<a title="<?php _e( 'Edit', self::$textdomain ); ?> <?php echo $cpt['labels']['name']; ?>" href="<?php echo $edit_link; ?>" class="row-title"><?php echo $cpt['labels']['name']; ?></a>
							</strong>	
						</td>							
						<td class="post-title">
							<?php echo $cpt['description']; ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>		
</div>