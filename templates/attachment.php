<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while (have_posts()): the_post();?>
	<article id="post-<?php the_ID();?>" <?php post_class();?>>
	<header class="entry-header">
	<?php echo urldecode(the_title('<h1 class="entry-title">', '</h1>', false)); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php echo json_encode(wp_get_attachment_metadata()); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

	</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
	<?php endwhile;?>