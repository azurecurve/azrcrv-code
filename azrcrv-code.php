<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name: Code
 * Description: Set of shortcodes which can be used for syntax highlighting of code.
 * Version: 1.1.0
 * Author: azurecurve
 * Author URI: https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI: https://development.azurecurve.co.uk/classicpress-plugins/code
 * Text Domain: code
 * Domain Path: /languages
 * ------------------------------------------------------------------------------
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.html.
 * ------------------------------------------------------------------------------
 */

// Prevent direct access.
if (!defined('ABSPATH')){
	die();
}

// include plugin menu
require_once(dirname( __FILE__).'/pluginmenu/menu.php');
register_activation_hook(__FILE__, 'azrcrv_create_plugin_menu_c');

// include update client
require_once(dirname(__FILE__).'/libraries/updateclient/UpdateClient.class.php');

/**
 * Setup registration activation hook, actions, filters and shortcodes.
 *
 * @since 1.0.0
 *
 */
// add actions
register_activation_hook(__FILE__, 'azrcrv_c_set_default_options');

// add actions
add_action('admin_menu', 'azrcrv_c_create_admin_menu');
add_action('admin_post_azrcrv_c_save_options', 'azrcrv_c_save_options');
add_action('wp_enqueue_scripts', 'azrcrv_c_load_css');
//add_action('the_posts', 'azrcrv_c_check_for_shortcode');
add_action('plugins_loaded', 'azrcrv_cob_load_languages');

// add filters
add_filter('plugin_action_links', 'azrcrv_c_add_plugin_action_link', 10, 2);
add_filter('the_content', 'azrcrv_fix_shortcodes');
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'azrcrv_c_preformat_postcode_shortcode', 99);

// add shortcodes
add_shortcode('formatcode', 'azrcrv_c_format');
add_shortcode('FORMATCODE', 'azrcrv_c_format');
add_shortcode('postcode', 'azrcrv_c_format');
add_shortcode('POSTCODE', 'azrcrv_c_format');
add_shortcode('gray', 'azrcrv_c_grey');
add_shortcode('GRAY', 'azrcrv_c_grey');
add_shortcode('grey', 'azrcrv_c_grey');
add_shortcode('GREY', 'azrcrv_c_grey');
add_shortcode('blue', 'azrcrv_c_blue');
add_shortcode('BLUE', 'azrcrv_c_blue');
add_shortcode('red', 'azrcrv_c_red');
add_shortcode('RED', 'azrcrv_c_red');
add_shortcode('pink', 'azrcrv_c_pink');
add_shortcode('PINK', 'azrcrv_c_pink');
add_shortcode('green', 'azrcrv_c_green');
add_shortcode('GREEN', 'azrcrv_c_green');
add_shortcode('sqlgray', 'azrcrv_c_grey');
add_shortcode('SQLGRAY', 'azrcrv_c_grey');
add_shortcode('sqlgrey', 'azrcrv_c_grey');
add_shortcode('SQLGREY', 'azrcrv_c_grey');
add_shortcode('sqlblue', 'azrcrv_c_blue');
add_shortcode('sqlBlue', 'azrcrv_c_blue');
add_shortcode('sqlBLUE', 'azrcrv_c_blue');
add_shortcode('sqlred', 'azrcrv_c_red');
add_shortcode('sqlRed', 'azrcrv_c_red');
add_shortcode('sqlRED', 'azrcrv_c_red');
add_shortcode('sqlpink', 'azrcrv_c_pink');
add_shortcode('sqlPink', 'azrcrv_c_pink');
add_shortcode('sqlPINK', 'azrcrv_c_pink');
add_shortcode('sqlgreen', 'azrcrv_c_green');
add_shortcode('sqlGreen', 'azrcrv_c_green');
add_shortcode('sqlGREEN', 'azrcrv_c_green');
add_shortcode('phpgray', 'azrcrv_c_grey');
add_shortcode('PHPGRAY', 'azrcrv_c_grey');
add_shortcode('phpgrey', 'azrcrv_c_grey');
add_shortcode('PHPGREY', 'azrcrv_c_grey');
add_shortcode('phpblue', 'azrcrv_c_blue');
add_shortcode('PHPBLUE', 'azrcrv_c_blue');
add_shortcode('phpgreen', 'azrcrv_c_phpgreen');
add_shortcode('PHPGREEN', 'azrcrv_c_phpgreen');
add_shortcode('copyright', 'azrcrv_c_copyright');
add_shortcode('COPYRIGHT', 'azrcrv_c_copyright');
add_shortcode('highlight', 'azrcrv_c_highlight');
add_shortcode('HIGHLIGHT', 'azrcrv_c_highlight');
add_shortcode('hl', 'azrcrv_c_highlight');
add_shortcode('HL', 'azrcrv_c_highlight');
add_shortcode('gpmenu', 'azrcrv_c_gpmenu');
add_shortcode('GPMENU', 'azrcrv_c_gpmenu');

/**
 * Load language files.
 *
 * @since 1.0.0
 *
 */
function azrcrv_cob_load_languages() {
    $plugin_rel_path = basename(dirname(__FILE__)).'/languages';
    load_plugin_textdomain('azrcrv-cob', false, $plugin_rel_path);
}

/**
 * Check if shortcode on current page and then load css and jqeury.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_check_for_shortcode($posts){
    if (empty($posts)){
        return $posts;
	}
	
	
	// array of shortcodes to search for
	$shortcodes = array(
						'formatcode','FORMATCODE','postcode','POSTCODE','gray','GRAY','grey','GREY','blue','BLUE','red','RED','pink','PINK','green','GREEN','sqlgray','SQLGRAY','sqlgrey','SQLGREY','sqlblue','SQLBLUE','sqlred','SQLRED','sqlpink','SQLPINK','sqlgreen','SQLGREEN','phpgray','PHPGRAY','phpgrey','PHPGREY','phpblue','PHPBLUE','phpgreen','PHPGREEN','copyright','COPYRIGHT','highlight','HIGHLIGHT','hl','HL','gpmenu','GPMENU'
						);
	
    // loop through posts
    $found = false;
    foreach ($posts as $post){
		// loop through shortcodes
		foreach ($shortcodes as $shortcode){
			// check the post content for the shortcode
			if (has_shortcode($post->post_content, $shortcode)){
				$found = true;
				// break loop as shortcode found in page content
				break 2;
			}
		}
	}
 
    if ($found){
		// as shortcode found call functions to load css and jquery
        azrcrv_c_load_css();
    }
    return $posts;
}

/**
 * Load CSS.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_load_css(){
	wp_enqueue_style('azrcrv-c', plugins_url('assets/css/style.css', __FILE__), '', '1.0.0');
}

/**
 * Set default options for plugin.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_set_default_options($networkwide){
	
	$option_name = 'azrcrv-c';
	$old_option_name = 'azc_c_options';
	
	$new_options = array(
						'copyright' => '#007FFF',
			);
	
	// set defaults for multi-site
	if (function_exists('is_multisite') && is_multisite()){
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide){
			global $wpdb;

			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			$original_blog_id = get_current_blog_id();

			foreach ($blog_ids as $blog_id){
				switch_to_blog($blog_id);

				if (get_option($option_name) === false){
					if (get_option($old_option_name) === false){
						add_option($option_name, $new_options);
					}else{
						add_option($option_name, get_option($old_option_name));
					}
				}
			}

			switch_to_blog($original_blog_id);
		}else{
			if (get_option($option_name) === false){
				if (get_option($old_option_name) === false){
					add_option($option_name, $new_options);
				}else{
					add_option($option_name, get_option($old_option_name));
				}
			}
		}
		if (get_site_option($option_name) === false){
				if (get_option($old_option_name) === false){
					add_option($option_name, $new_options);
				}else{
					add_option($option_name, get_option($old_option_name));
				}
		}
	}
	//set defaults for single site
	else{
		if (get_option($option_name) === false){
				if (get_option($old_option_name) === false){
					add_option($option_name, $new_options);
				}else{
					add_option($option_name, get_option($old_option_name));
				}
		}
	}
}

/**
 * Add Code action link on plugins page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_add_plugin_action_link($links, $file){
	static $this_plugin;

	if (!$this_plugin){
		$this_plugin = plugin_basename(__FILE__);
	}

	if ($file == $this_plugin){
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=azrcrv-c">'.esc_html__('Settings' ,'code').'</a>';
		array_unshift($links, $settings_link);
	}

	return $links;
}

/**
 * Add to menu.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_create_admin_menu(){
	//global $admin_page_hooks;
	
	add_submenu_page("azrcrv-plugin-menu"
						,esc_html__("Code Settings", "code")
						,esc_html__("Code", "code")
						,'manage_options'
						,'azrcrv-c'
						,'azrcrv_c_display_options');
}

/**
 * Display Settings page.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_display_options(){
	if (!current_user_can('manage_options')){
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'code'));
    }
	
	// Retrieve plugin configuration options from database
	$options = get_option('azrcrv-c');
	?>
	<div id="azrcrv-c-general" class="wrap">
		<fieldset>
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<?php if(isset($_GET['settings-updated'])){ ?>
				<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Settings have been saved.', 'code'); ?></strong></p>
				</div>
			<?php } ?>
			<form method="post" action="admin-post.php">
				<input type="hidden" name="action" value="azrcrv_c_save_options" />
				<input name="page_options" type="hidden" value="copyright" />
				
				<!-- Adding security through hidden referrer field -->
				<?php wp_nonce_field('azrcrv-c', 'azrcrv-c-nonce'); ?>
				<table class="form-table">
				
				<tr><th scope="row"><label for="code"><?php esc_html_e('Copyright', 'code'); ?></label></th><td>
					<textarea name="copyright" rows="15" cols="50" id="copyright" class="large-text code"><?php echo esc_textarea(stripslashes($options['copyright'])) ?></textarea>
				</td></tr>
				
				<tr><th scope="row"><label for="max_length"><?php esc_html_e('Shortcodes', 'code'); ?></label></th><td>
					postcode - <?php esc_html_e('place pre and span tags around code', 'code'); ?><br />
					copyright - <?php esc_html_e('add copyright text', 'code'); ?><br />
					highlight - <?php esc_html_e('highlight text in yellow', 'code'); ?><br />
					sqlblue - <?php esc_html_e('show text in sql blue', 'code'); ?><br />
					sqlgrey - <?php esc_html_e('show text in sql grey', 'code'); ?><br />
					sqlgray - <?php esc_html_e('show text in sql gray (same as sql grey)', 'code'); ?><br />
					sqlpink - <?php esc_html_e('show text in sql pink', 'code'); ?><br />
					sqlgreen - <?php esc_html_e('show text in sql green', 'code'); ?><br />
					phpblue - <?php esc_html_e('show text in php blue', 'code'); ?><br />
					phpgrey - <?php esc_html_e('show text in sql php grey', 'code'); ?><br />
					phpgreen - <?php esc_html_e('show text in php green', 'code'); ?>
				</td></tr>
				
				</table>
				<input type="submit" value="Save Changes" class="button-primary"/>
			</form>
		</fieldset>
	</div>
	<?php
}

/**
 * Save settings.
 *
 * @since 1.0.0
 *
 */
function azrcrv_c_save_options(){
	// Check that user has proper security level
	if (!current_user_can('manage_options')){
		wp_die(esc_html__('You do not have permissions to perform this action', 'code'));
	}
	// Check that nonce field created in configuration form is present
	if (! empty($_POST) && check_admin_referer('azrcrv-c', 'azrcrv-c-nonce')){
	
		// Retrieve original plugin options array
		$options = get_option('azrcrv-c');
		
		$option_name = 'copyright';
		if (isset($_POST[$option_name])){
			$options[$option_name] = implode("\n", array_map('sanitize_text_field', explode("\n", $_POST[$option_name])));
		}
		
		// Store updated options array to database
		update_option('azrcrv-c', $options);
		
		// Redirect the page to the configuration form that was processed
		wp_redirect(add_query_arg('page', 'azrcrv-c&settings-updated', admin_url('admin.php')));
		exit;
	}
}

function azrcrv_c_preformat_postcode_shortcode($content){
       $new_content = '';
       $pattern_full = '{(\[postcode\].*?\[/postcode\])}is';
       $pattern_contents = '{\[postcode\](.*?)\[/postcode\]}is';
       $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

       foreach ($pieces as $piece){
               if (preg_match($pattern_contents, $piece, $matches)){
                       $new_content .= $matches[1];
               } else {
                       $new_content .= wptexturize(wpautop($piece));
               }
       }

       return $new_content;
}

function azrcrv_fix_shortcodes($content){   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

function azrcrv_c_format($atts, $content = null){
	return "<pre><span class='azrcrv-c-code'>".do_shortcode($content)."</span></pre>";
}

function azrcrv_c_grey($atts, $content = null){
	return "<span class='azrcrv-c-sqlgrey'>".do_shortcode($content)."</span>";
}

function azrcrv_c_blue($atts, $content = null){
	return "<span class='azrcrv-c-sqlblue'>".do_shortcode($content)."</span>";
}

function azrcrv_c_red($atts, $content = null){
	return "<span class='azrcrv-c-sqlred'>".do_shortcode($content)."</span>";
}

function azrcrv_c_pink($atts, $content = null){
	return "<span class='azrcrv-c-sqlpink'>".do_shortcode($content)."</span>";
}

function azrcrv_c_green($atts, $content = null){
	return "<span class='azrcrv-c-sqlgreen'>".do_shortcode($content)."</span>";
}

function azrcrv_c_phpgrey($atts, $content = null){
	return "<span class='azrcrv-c-phpgrey'>".do_shortcode($content)."</span>";
}

function azrcrv_c_phpblue($atts, $content = null){
	return "<span class='azrcrv-c-phpblue'>".do_shortcode($content)."</span>";
}

function azrcrv_c_phpgreen($atts, $content = null){
	return "<span class='azrcrv-c-phpgreen'>".do_shortcode($content)."</span>";
}

function azrcrv_c_copyright($atts, $content = null){
	$options = get_option('azrcrv-c');
	return "<span class='azrcrv-c-sqlgreen'>/*<br />".
esc_textarea(stripslashes($options['copyright']))."
*/</span>";
}

function azrcrv_c_highlight($atts, $content = null){
	return "<span class='azrcrv-c-highlight'>".do_shortcode($content)."</span>";
}

function azrcrv_c_gpmenu($atts, $content = null){
	return "(<span class='azrcrv-c-gpmenu'>".do_shortcode($content)."</span>)";
}

?>