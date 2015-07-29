<?php
/**
 *
 * Code to create Featured metabox
 *
 **/

/**
 * Adds a meta box to the post editing screen
 */

function prfx_checkbox_meta() {
    add_meta_box( 'prfx_meta', __( 'Personal Options' ), 'prfx_meta_callback', 'page', 'side', 'high' );
   // add_meta_box( 'prfx_meta', __( 'Personal Options' ), 'prfx_meta_callback', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'prfx_checkbox_meta' );

/**
 * Outputs the content of the meta box
 */

function prfx_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
    <p>
        <label for="sg-checkbox"></label>
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], '' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'General' ); ?></span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="about" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'about' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'About' ); ?></span><br />
       <input type="radio" name="sg-checkbox" id="sg-checkbox" value="sidebar" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'sidebar' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'Sidebar' ); ?></span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="sidebar-menu" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'sidebar-menu' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'Sidebar' ); ?>-<?php _e( 'Menu' ); ?> 1</span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="sidebar-menu1" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'sidebar-menu1' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'Sidebar' ); ?>-<?php _e( 'Menu' ); ?> 2</span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="sidebar-menu2" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'sidebar-menu2' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'Sidebar' ); ?>-<?php _e( 'Menu' );3 ?> 3</span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="sidebar-menu3" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'sidebar-menu3' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'Sidebar' ); ?>-<?php _e( 'Menu' ); ?> 4</span><br />
        <input type="radio" name="sg-checkbox" id="sg-checkbox" value="faq" <?php if ( isset ( $prfx_stored_meta['sg-checkbox'] ) ) checked( $prfx_stored_meta['sg-checkbox'][0], 'faq' ); ?> />
        <span class="prfx-row-title"><?php _e( 'Style' ); ?> - <?php _e( 'FAQ' ); ?></span><br />
    </p><hr />
    <p>
        <span class="prfx-row-contact"><?php _e( 'Add Custom Field' )?> - <?php _e('Select Category'); ?></span>
        <label for="sg-cat">
            <select name="sg-cat" id="sg-cat">
                <option value=""><?php _e('Empty Term'); ?></option>
                <?php
                    if( $categories = get_categories() ){
                        foreach($categories as $cat){
                            printf( '<option value="%1$s"%3$s>%2$s</option>',
                                $cat->term_id ,
                                esc_html( $cat->name  ),
                                selected( esc_attr( (( isset ( $prfx_stored_meta['sg-cat'] ) ) ? $prfx_stored_meta['sg-cat'][0] : '')) , $cat->term_id, false )
                            );
                        }
                    }
                ?>
            </select>
        </label>
        <hr />
    </p>
    <p>
	    <span class="prfx-row-test"><?php _e( 'Title' )?> - <?php _e('Test input'); ?></span>
        <label for="sg-test">
            <input type="text" name="sg-test" id="sg-test" value="<?php if ( isset ( $prfx_stored_meta['sg-test'] ) ) echo $prfx_stored_meta['sg-test'][0]; ?>" />
        </label><br />
	</p><hr />
<?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {

    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    // Checks for input and saves - save checked as yes and unchecked at no

    $new_meta_value = ( isset( $_POST['sg-checkbox'] ) ? sanitize_html_class( $_POST['sg-checkbox'] ) : '' );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'sg-checkbox', $new_meta_value );

    if( isset( $_POST[ 'sg-cat' ] ) ) {
        update_post_meta( $post_id, 'sg-cat', $_POST[ 'sg-cat' ] );
    }

    if( isset( $_POST[ 'sg-test' ] ) ) {
        update_post_meta( $post_id, 'sg-test', $_POST[ 'sg-test' ] );
    }


}
add_action( 'save_post', 'prfx_meta_save' );