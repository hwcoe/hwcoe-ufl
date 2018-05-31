<?php 
/**
 * RSS Feed Widget
 *
 * @package HWCOE_UFL
 * @since 0.1.0
 */
class UFL_2015_Widget_RSS extends WP_Widget {
/**
	 * Sets up the widget name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'widget-ufl-rss',
			'description' => __('Insert an RSS feed from another website.', 'hwcoe-ufl'),
			'customize_selective_refresh' => true,
		);
		$control_ops = array();
		parent::__construct( 'ufl-rss', __('UFL RSS Feed', 'hwcoe-ufl'), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$url = empty($instance['url']) ? '' : apply_filters('widget_text', $instance['url']);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$items = empty($instance['items']) ? '5' : apply_filters('widget_text', $instance['items']);
		$rss_alt_url = empty($instance['rss_alt_url']) ? '' : apply_filters('widget_text', $instance['rss_alt_url']);
		$rss_showimage = isset($instance['rss_showimage']) ? $instance['rss_showimage'] : false;
		$show_summary = isset($instance['show_summary']) ? $instance['show_summary'] : false;
		$show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
		$rss_icon = isset($instance['rss_icon']) ? $instance['rss_icon'] : false;

		// if both rss url and alternate url is empty then exit
		if (empty($url) && empty($rss_alt_url)):
			return;

		echo $args['before_widget'];

		if (!empty($rss_icon)) {
			$icon = get_stylesheet_directory_uri() . "/img/spritemap.svg#feed";
			
			$showrssiconimage = "<a href='" . $url . "' class='icon-svg icon-feed'><svg><use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='". $url . "'></use></svg></a>";
		}

		// Get RSS Feed(s)
		include_once(ABSPATH . WPINC . '/feed.php');

		$url = preg_replace('( )', '', $url);	// strip spaces
		$url_array = split("," $url);	// turn comma delimited string of feeds into array

		if (count($url_array) > 1)	// if there's more than one feed
			$rss = fetch_feed($url_array);
		else
			$rss = fetch_feed($url);
		
		if (!is_wp_error($rss)) :	
			$maxitems = $rss->get_item_quantity($items);
			$rss_items = $rss->get_items(0, $maxitems);		// builds an array from 0 to item max

		endif;

		if (empty($rss_alt_url)) {
			$rss_link = esc_url(strip_tags($rss->get_permalink()));
			$rss_link = "<a href='{$rss_link}'>";
		} else {
			$rss_link = esc_url(strip_tags($rss_alt_url));
			$rss_link = "<a href='{$rss_link}'>";
		}
		if (!empty($rss_link)) {
			$rss_link_a = "</a>";
		}
		if (empty($title)) {
			$title = $rss->get_title();
		}

		echo $before_title . $rss_link . $title . $rss_link_a . $showrssiconimage . $after_title;

		if ($maxitems == 0) {
			$rss_widget_output = '<p>See ';
			if ($rss_alt_url) {
				$rss_widget_output .= '<a href="' . esc_attr($rss_alt_url) . '">' . esc_html($title) . '</a>';
			} else {
				$rss_widget_output .= esc_html($title);
			}
			$rss_widget_output .= ' for the latest stories.</p>';
		} else {
			$rss_widget_output .="<ul class='lcp_catlist'>";
			foreach ($rss_items as $item) :

				// find images
				if (!empty($rss_showimage)) {
					$pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
					preg_match($pattern, $item->get_content(), $img_matches);
					$trimmed_img_matches = trim($img_matches[0], "src=");
				}

				$rss_widget_output .= "<li>";
				$rss_widget_output .= the_title( sprintf( '<h3 class="lcp_post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); 

				if (!empty($trimmed_img_matches)) {
					$rss_widget_output .= "<a href='{$item->get_permalink()}'><img class='thumbnail' src={$trimmed_img_matches} alt='{$item->get_title()}' /></a>";
				}

		echo $args['after_widget'];
	}
}