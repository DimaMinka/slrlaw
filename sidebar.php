<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package slrlaw
 */

$sidebar_menu_name = get_post_meta( get_the_ID(), 'sg-checkbox', true );

if(get_post_meta( get_the_ID(), 'sg-checkbox', true ) == 'sidebar' || is_single()) {
    $my_excerpt = '';
    if ( !is_single() ) {
         $my_excerpt = get_the_excerpt();
        if ( '' != $my_excerpt ) {
            $my_excerpt_str = explode("\n",$my_excerpt);
            $my_excerpt_row = "";
            $k = 0;
            foreach ($my_excerpt_str as $row) {
                if (0 == $k && '' != $row) {
                    $output .= "<h4 class='sg-member-title'>$row</h4><p>";
                    $k = 1;
                }else {
                    $output .= "$row<br>";
                }

            }

            $my_excerpt = '<div class="sg-member-info">'.preg_replace('/([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/', '<a href="mailto:$1">$1</a>', $output).'</p></div>';
        }
    }
?>

<aside class="sg-sidebar">
    <div class="sg-widget-info">
        <div class="sg-thumb-wrap">
            <div class="sg-thumb-thumb"><?php if ( has_post_thumbnail( get_the_ID() ) ) the_post_thumbnail( 'sidebar-thumb', array('class' => 'sg-member-img', 'alt' => get_the_title() ) ); ?></div>
        </div>
        <?php echo $my_excerpt; ?>
    </div>
</aside>

<?php
} elseif(is_page() && $sidebar_menu_name == ('sidebar-menu' || 'sidebar-menu1' || 'sidebar-menu2' || 'sidebar-menu3')) {

    $parent_page = ($post->post_parent ? $post->post_parent : get_the_ID());
    $current_ID = get_the_ID();
    $args = array('post_type' => 'page', 'post_parent' => $parent_page, 'orderby' => 'menu_order', 'order' => 'ASC');
    $myposts = get_posts($args);

    foreach ($myposts as $post) : setup_postdata($post);

        $sub_pages .= sprintf('<li class="sub-pages-item%s"><a href="%s">%s</a></li>', ($current_ID == $post->ID ? ' current' : ''), get_permalink(), get_the_title());

    endforeach; wp_reset_postdata();

    printf('
        <aside class="sg-sidebar">
            <div class="sg-widget-subpages">
                <div class="sg-subpage-icons">
                    <i class="sg-icons icon-side1%1$s"></i>
                    <i class="sg-icons icon-side2%2$s"></i>
                    <i class="sg-icons icon-side3%3$s"></i>
                    <i class="sg-icons icon-side4%4$s"></i>
                </div>
                <nav class="sg-subpages-nav">
                    <ul class="sg-subpages-list%1$s%2$s%3$s%4$s">
                    %5$s
                    </ul>
                </nav>
            </div>
        </aside>',
        ($sidebar_menu_name == 'sidebar-menu' ? ' current color1' : ''),
        ($sidebar_menu_name == 'sidebar-menu1' ? ' current color2' : ''),
        ($sidebar_menu_name == 'sidebar-menu2' ? ' current color3' : ''),
        ($sidebar_menu_name == 'sidebar-menu3' ? ' current color4' : ''),
        $sub_pages
    );
}