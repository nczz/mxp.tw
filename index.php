<?php
get_header();

$template = 'index';
if (is_embed() && $template = 'embed'):
elseif (is_404() && $template = '404'):
elseif (is_search() && $template = 'search'):
elseif (is_front_page() && $template = 'front_page'):
elseif (is_home() && $template = 'home'):
elseif (is_post_type_archive() && $template = 'post_type_archive'):
elseif (is_tax() && $template = 'taxonomy'):
elseif (is_attachment() && $template = 'attachment'):
elseif (is_single() && $template = 'single'):
elseif (is_page() && $template = 'page'):
elseif (is_singular() && $template = 'singular'):
elseif (is_category() && $template = 'category'):
elseif (is_tag() && $template = 'tag'):
elseif (is_author() && $template = 'author'):
elseif (is_date() && $template = 'date'):
elseif (is_archive() && $template = 'archive'):
else:
	$template = 'index';
endif;
if ($template != 'index') {
	include 'templates/' . $template . '.php';
} else {
	echo 'tpl:' . $template . '<br/>';
}

get_footer();