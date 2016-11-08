<?php
class Mxp_theme {
	public $slug = 'mxp-theme';
	protected static $instance = null;
	public function __construct() {
		$this->init();
	}
	public function init() {
		add_action('get_header', array($this, 'load_header_resource'));
		add_action('get_footer', array($this, 'load_footer_resource'));
		add_action('the_author_posts_link', array($this, 'author_posts_link'));
		$this->register_sidebar_widgets();
		$this->register_menus();
		$this->theme_support();
		$this->optmize_theme();
	}
	public static function get_instance() {
		if (null == self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function load_header_resource() {
		$path_uri = get_template_directory_uri() . '/include/';
		wp_register_style($this->slug . '-material-css', $path_uri . 'css/material.min.css');
		wp_enqueue_style($this->slug . '-google-fonts-cwtexyen', '//fonts.googleapis.com/earlyaccess/cwtexyen.css', array(), null);
		wp_enqueue_style($this->slug . '-google-fonts-material-icons', '//fonts.googleapis.com/icon?family=Material+Icons', array(), null);
		wp_enqueue_style($this->slug . '-material-css');
		wp_enqueue_style($this->slug . '-yue-css', $path_uri . 'css/yue.css');
		wp_enqueue_style($this->slug . '-main-css', get_template_directory_uri() . '/style.css');
	}
	public function load_footer_resource() {
		$path_uri = get_template_directory_uri() . '/include/';
		wp_register_script($this->slug . '-material-js', $path_uri . 'js/material.js', array('jquery'), false);
		wp_enqueue_script($this->slug . '-material-js');
	}
	public function register_menus() {
		register_nav_menus(
			array(
				'main-menu' => '主選單',
				'side-menu' => '側選單',
			)
		);
	}
	public function register_sidebar_widgets() {
		register_sidebar(array(
			'name' => '左邊欄',
			'id' => 'sidebar-l',
			'description' => '加入左側邊欄元素',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
		register_sidebar(array(
			'name' => '右邊欄',
			'id' => 'sidebar-r',
			'description' => '加入右側邊欄元素',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	}
	public function remove_default_image_sizes($sizes) {
		unset($sizes['thumbnail']);
		unset($sizes['medium']);
		unset($sizes['large']);
		return $sizes;
	}
	public function theme_support() {
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		/*
			 https://developers.facebook.com/docs/sharing/best-practices
			 圖像尺寸
			 請對高解析度裝置使用至少 1200 x 630 像素以獲得最佳顯示。您應該至少使用 600 x 315 像素的圖像來顯示具有更大圖像的連結網頁貼文。圖像大小最大可為 8MB。
		*/
		//set_post_thumbnail_size(1200, 630);

		//最小幾乎用不到
		update_option('thumbnail_size_w', 0);
		update_option('thumbnail_size_h', 0);
		//設定中間值滿足基本條件即可
		update_option('medium_size_w', 600);
		update_option('medium_size_h', 315);
		//最大又通常因為圖長寬不足壓不到
		update_option('large_size_w', 0);
		update_option('large_size_h', 0);
		add_filter('intermediate_image_sizes_advanced', array($this, 'remove_default_image_sizes'));
	}
	public function optmize_theme() {
		//整理head資訊
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		add_filter('the_generator', '__return_false');
		add_filter('show_admin_bar', '__return_false');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('wp_head', 'feed_links_extra', 3);
		//移除css, js資源載入時的版本資訊
		add_filter('style_loader_src', array($this, 'remove_version_query'), 999);
		add_filter('script_loader_src', array($this, 'remove_version_query'), 999);
		//後台顯示資訊
		add_filter('admin_footer_text', array($this, 'footer_theme_info'));
		//摘要調整
		add_filter('excerpt_length', array($this, 'mxp_theme_custom_excerpt_length'), 999);
		add_filter('excerpt_more', array($this, 'mxp_theme_excerpt_more'));
	}
	public function remove_version_query($src) {
		if (strpos($src, 'ver=')) {
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}
	public static function footer_theme_info() {
		echo '<span id="footer-info">Developed & Copyright © by <a href="https://www.mxp.tw">一介資男</a>  © ' . date("Y") . '</span>';
	}
	public function mxp_theme_ajax_get_post() {
		$post_type = $_POST['post_type'];
		$page_num = $_POST['page_num'];
		if (isset($post_type)) {
			wp_send_json_error(array('msg' => 'No joke here.'));
		}
		global $wp_query;
		$max_pages = $wp_query->max_num_pages;
		$display_count = get_option('posts_per_page');
		if (isset($page_num) && is_numeric($page_num)) {
			$page = intval($page_num);
		} else {
			$page = get_query_var('paged') ? get_query_var('paged') : 1;
		}
		if ($page > $max_pages) {
			$page = $max_pages;
		}
		$offset = ($page - 1) * $display_count;
		$query_args = array(
			'post_type' => $post_type,
			'orderby' => 'date',
			'order' => 'desc',
			'number' => $display_count,
			'page' => $page,
			'offset' => $offset,
		);
		$custom_query = new WP_Query($query_args);
		$posts = $custom_query->get_posts();
		$post_arr = [];
		for ($i = 0; $i < count($posts); ++$i) {
			//TODO: filter
			$post_arr[] = $posts[$i];
		}
		return json_encode($post_arr, true);
	}
	public function mxp_theme_custom_excerpt_length($length) {
		return 100;
	}
	public function mxp_theme_excerpt_more($more) {
		return ' ... ';
	}
	public static function mxp_theme_pre_render_link($link) {
		//echo "<link rel='prerender' href='{$link}''>";
	}
	public static function mxp_theme_get_custom_menu($theme_location) {
		$main_menu_list = '';
		if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
			$menu = get_term($locations[$theme_location], 'nav_menu');
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$main_menu = [];
			$sub_menu = [];
			//Find main menu
			for ($i = 0; $i < count($menu_items); ++$i) {
				if ($menu_items[$i]->menu_item_parent == "0") {
					$main_menu[] = $menu_items[$i];
					unset($menu_items[$i]);
				}
			}
			//Find sub menu
			$menu_items = array_values($menu_items);
			for ($i = 0; $i < count($main_menu); ++$i) {
				$index = -1;
				for ($j = 0; $j < count($menu_items); ++$j) {
					if ($menu_items[$j]->menu_item_parent == (string) $main_menu[$i]->ID) {
						$sub_menu[] = $menu_items[$j];
						$main_menu[$i]->have_sub = true;
						$index = $j;
					}
				}
				if ($index != -1) {
					unset($menu_items[$index]);
					$menu_items = array_values($menu_items);
				}
			}
			//remove sub from menu items
			for ($i = 0; $i < count($sub_menu); ++$i) {
				$index = -1;
				for ($j = 0; $j < count($menu_items); ++$j) {
					if ($sub_menu[$i]->ID == $menu_items[$j]->ID) {
						$index = $j;
					}
				}
				if ($index != -1) {
					unset($menu_items[$index]);
					$menu_items = array_values($menu_items);
				}
			}
			//Put other menu items to main menu
			$main_menu = array_merge($main_menu, $menu_items);
			//Make main menu list
			$menu_list = '<nav class="mdl-navigation">';
			for ($i = 0; $i < count($main_menu); ++$i) {
				if ($main_menu[$i]->have_sub) {
					$menu_list .= '<a id="submenu-' . $main_menu[$i]->ID . '" class="mdl-navigation__link submenu" href="#">' . $main_menu[$i]->title . '</a>';
				} else {
					$menu_list .= '<a class="mdl-navigation__link" href="' . $main_menu[$i]->url . '">' . $main_menu[$i]->title . '</a>';
				}
			}
			$menu_list .= '</nav>';
			$sub_list = [];
			$sub_list_map = [];
			for ($i = 0; $i < count($sub_menu); ++$i) {
				$id = $sub_menu[$i]->menu_item_parent;
				$index = $i;
				if (isset($sub_list_map[$id . '_' . $index])) {
					$sub_list_map[$id . '_' . $index]++;
				} else {
					$sub_list_map[$id . '_' . $index] = 0;
				}
			}
			foreach ($sub_list_map as $id => $count) {
				$key = explode('_', $id);
				if (!isset($sub_list[$key[0]])) {
					$sub_list[$key[0]] = '';
				}
				$sub_list[$key[0]] .= '<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="submenu-' . $sub_menu[$key[1]]->menu_item_parent . '">';
				for ($i = 0; $i < count($sub_menu); ++$i) {
					if ($sub_menu[$i]->menu_item_parent == $key[0]) {
						$sub_list[$key[0]] .= '<li class="mdl-menu__item"><a href="' . $sub_menu[$i]->url . '">' . $sub_menu[$i]->title . '</a></li>';
					}
				}
				$sub_list[$key[0]] .= '</ul>';
			}
			//combine
			$sub_total = '';
			foreach ($sub_list as $key => $value) {
				$sub_total .= $value;
			}
			$main_menu_list = $menu_list . $sub_total;
		} else {
			$main_menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
		}
		//echo $menu_list;
		//echo '<script>console.log("menu",' . json_encode($menu_items) . ');</script>';
		echo $main_menu_list;
	}
	public function author_posts_link($link) {
		$link = get_the_author_link();
		return $link;
	}
}

add_action('after_setup_theme', array('Mxp_theme', 'get_instance'));
