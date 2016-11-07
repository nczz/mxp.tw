<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--1-col"></div>
	<div class="mdl-cell mdl-cell--10-col">
	<div class="mdl-grid">
		<?php if (have_posts()): ?>
		<?php while (have_posts()): ?>
		<?php the_post();?>
		<?php $post_type = get_post_type();?>
		<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
			<!-- posts -->
			<article class="<?php echo $post_type; ?> yue single-post-page" itemscope itemtype="http://schema.org/Article">
				<?php if (has_post_thumbnail()): ?>
					<div class="<?php echo $post_type; ?>-thumb-image" style="display: none">
						<img itemprop="image" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="<?php the_title();?>" width="150" height="150">
					</div>
				<?php endif;?>
				<div class="<?php echo $post_type; ?>-content content">
					<header class="<?php echo $post_type; ?>-header header post-<?php the_ID();?>">

						<h2 class="<?php echo $post_type; ?>-name name" itemprop="name headline">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title();?></a>
						</h2>

					</header>
					<div class="<?php echo $post_type; ?>-excerpt excerpt" itemprop="description">

						<p><?php the_content();?></p>

					</div>
					<footer class="<?php echo $post_type; ?>-meta meta">

						<ul style="display:block">
							<li><a href="" rel="category tag"><?php the_category(', ');?></a></li>
							<li><time datetime="<?php the_time('Y-m-d\TH:i:sP')?>" itemprop="datePublished" pubdate><?php the_date('Y/m/d');?></time></li>
							<li>by <span itemprop="author"><?php the_author_posts_link();?></span></li>
						</ul>
					</footer>

				</div>
			</article>
			<!-- posts -->
		</div>
		<?php endwhile;?>

		<?php else: ?>
		<!-- 沒東西勒！ -->
		<div class="mdl-cell mdl-cell--12-col">
		<p>無相關內容呈現。</p>
		</div>
		<!-- 沒東西勒！ -->
		<?php endif;?>
	</div>
</div>
<div class="mdl-cell mdl-cell--1-col"></div>
</div>