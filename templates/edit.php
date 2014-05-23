<div class="wrap <?php echo self::$textdomain; ?>">
	<?php
		if ($post_type == 'new_custom_post_type') 
			$title  = __( 'Create Custom Post Type', self::$textdomain );
		else
			$title = __( 'Edit Custom Post Type', self::$textdomain ) . ' <b>' .$cpt['labels']['singular_name'] . '</b> <span class="will_be_deleted">(' .  __( 'will be deleted', self::$textdomain ) .')</span>';
	?>
	<h2><?php echo $title; ?></h2>
	<?php $this->notice(); ?><br>
	<form action="" method="POST">		
		<?php $this->form($post_type, $cpt); ?>		
	</form>
</div>

<script>
	window.toolset_menu_parent_id = 'toplevel_page_toolset';
	window.toolset_menu_page_href = 'toolset-custom-post-types';
</script>