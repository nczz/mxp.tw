<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while (have_posts()): the_post();?>
			<article id="post-<?php the_ID();?>" <?php post_class();?>>
				<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>');?>
				</header><!-- .entry-header -->

				<div class="entry-content">
				<?php the_content();

	$defaults = array(
		'before' => '<p>' . __('Pages:'),
		'after' => '</p>',
		'link_before' => '',
		'link_after' => '',
		'next_or_number' => 'number',
		'separator' => ' ',
		'nextpagelink' => __('Next page'),
		'previouspagelink' => __('Previous page'),
		'pagelink' => '%',
		'echo' => 1,
	);

	wp_link_pages($defaults);?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

			<?php endwhile;?>
	</main><!-- .site-main -->
</div><!-- .content-area -->