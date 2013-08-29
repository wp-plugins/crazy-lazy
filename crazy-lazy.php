<?php
/*
Plugin Name: Crazy Lazy
Description: Lazy Load WordPress Plugin
Author: Sergej M&uuml;ller
Author URI: http://wpcoder.de
Plugin URI: http://wordpress.org/plugins/crazy-lazy/
Version: 0.0.5
*/


/* Quit */
defined('ABSPATH') OR exit;


/* Fire */
add_action(
	'wp',
	array(
		'CrazyLazy',
		'instance'
	)
);


/* CrazyLazy class */
final class CrazyLazy {


	/**
	* Class instance
	*
	* @since   0.0.1
	* @change  0.0.1
	*/

	public static function instance()
	{
		new self();
	}


	/**
	* Class constructor
	*
	* @since   0.0.1
	* @change  0.0.4
	*/

	public function __construct()
  	{
  		/* Go home */
		if ( is_feed() OR is_admin() OR (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) OR (defined('DOING_CRON') && DOING_CRON) OR (defined('DOING_AJAX') && DOING_AJAX) OR (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) ) {
			return;
		}

		/* Hooks */
		add_filter(
			'the_content',
			array(
				__CLASS__,
				'prepare_images'
			)
		);
		add_filter(
			'post_thumbnail_html',
			array(
				__CLASS__,
				'prepare_images'
			)
		);
		add_action(
			'wp_enqueue_scripts',
			array(
				__CLASS__,
				'print_scripts'
			)
		);
	}


	/**
	* Prepare content images for Crazy Lazy usage
	*
	* @since   0.0.1
	* @change  0.0.5
	*
	* @param   string  $content  Original post content
	* @param   string  $content  Modified post content
	*/

	public static function prepare_images($content) {
		/* No lazy images? */
		if ( strpos($content, '-image') === false ) {
			return $content;
		}

		/* Empty gif */
		$null = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';

		/* Replace images */
		return preg_replace(
			array(
				'#<img(.+?)((?:wp-image-|wp-post-image).+?)src=["\'](.+?)["\'](.*?)/>(?!</noscript>)#',
				'#<img(.+?)src=["\'](.+?)["\'](.+?)((?:wp-image-|wp-post-image).+?)/>(?!</noscript>)#'
			),
			array(
				'<img$1crazy_lazy $2src="' .$null. '" data-src="$3"$4style="display:none"/><noscript><img$1$2src="$3"$4/></noscript>',
				'<img$1src="' .$null. '" data-src="$2"$3crazy_lazy $4style="display:none"/><noscript><img$1src="$2"$3$4/></noscript>'
			),
			$content
		);
	}


	/**
	* Print lazy load scripts in footer
	*
	* @since   0.0.1
	* @change  0.0.5
	*/

	public static function print_scripts()
	{
		/* Simulate nojQuery on Twenty Thirteen */
		//wp_deregister_script('jquery');

		/* Check for jQuery */
		if ( wp_script_is('jquery', 'registered') ) {
			self::_print_jquery_lazyload();
		} else {
			self::_print_javascript_lazyload();
		}
	}


	/**
	* Call unveil lazy load jQuery plugin
	*
	* @since   0.0.5
	* @change  0.0.5
	*/

	private static function _print_jquery_lazyload()
	{
		/* Globals */
		global $wp_scripts;

		/* Register script */
		wp_enqueue_script(
			'unveil.js',
			plugins_url(
				'/js/jquery.unveil.min.js',
				__FILE__
			),
			array('jquery'),
			'',
			true
		);

		/* Touch script */
		$wp_scripts->add_data(
			'unveil.js',
			'data',
			'jQuery(document).ready(function(){ jQuery("img.crazy_lazy").show(0).unveil(); });'
		);
	}

	/**
	* Call pure javascript lazyload.js
	*
	* @since   0.0.5
	* @change  0.0.5
	*/

	private static function _print_javascript_lazyload()
	{
		wp_enqueue_script(
			'lazyload.js',
			plugins_url(
				'/js/lazyload.min.js',
				__FILE__
			),
			array(),
			'',
			true
		);
	}
}