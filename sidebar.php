<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package slrlaw
 */

if(get_post_meta( get_the_ID(), 'sg-checkbox', true ) == 'sidebar') {

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

    $my_excerpt = preg_replace('/([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/', '<a href="mailto:$1">$1</a>', $output).'</p>';
}

?>

<aside class="sg-sidebar">
    <div class="sg-widget-info">
        <div class="sg-thumb-wrap">
            <div class="sg-thumb-thumb"><?php if ( has_post_thumbnail( get_the_ID() ) ) the_post_thumbnail( 'sidebar-thumb', array('class' => 'sg-member-img', 'alt' => get_the_title() ) ); ?></div>
        </div>
        <div class="sg-member-info">
        <?php echo $my_excerpt; ?>
        </div>
    </div>
</aside>

<?php }