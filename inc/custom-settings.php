<?php
/**
 * Custom settings
 * @package slrlaw
 */

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');
// END Disable support for comments and trackbacks in post types

function custom_gallery($attr) {
	$post = get_post();
	static $instance = 0;
	$instance++;
	$attr['columns'] = 1;
	$attr['size'] = 'full';
	$attr['link'] = 'file';
	$attr['orderby'] = 'post__in';
	$attr['include'] = $attr['ids'];
	$output = apply_filters('post_gallery', '', $attr);
	if ($output != '')
		return $output;
	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}
	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'figure',
		'icontag' => 'dt',
		'captiontag' => 'figcaption',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
	), $attr));
	$id = intval($id);
	if ('RAND' == $order)
		$orderby = 'none';
	if (!empty($include)) {
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif (!empty($exclude)) {
		$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
	} else {
		$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
	}
	if (empty($attachments))
		return '';
	$gallery_style = $gallery_div = '';
	$gallery_div = "<div class='sg-homepage-wrap'>";
	$output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);
	$i = 0;
	$src_url = '';
	$galleries = '';
	foreach ($attachments as $id => $attachment) {
		$i++;
		$link = wp_get_attachment_image_src($id, 'medium', false);
		$output .= sprintf('
			<div class="sg-home-block home-block-%1$s">
				<a class="sg-block-thumbnail" href="%2$s">
					<i class="sg-icons icon-item-%s" style="background-image:url(%3$s);"></i>
					<h2 class="sg-home-title">%4$s</h2>
				</a>
				<p class="sg-home-desc">
					<a href="%1$s">%5$s</a>
				</p>
			</div>',
			$i,
			get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
			$link[0],
			$attachment->post_excerpt,
			$attachment->post_content
		);

	}
	$output .= "</div>\n";
	return $output;
}