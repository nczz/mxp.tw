<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div class="mdl-cell mdl-cell--6-col">
	<div class="mdl-grid">
		<?php if (have_posts()): ?>
		<?php while (have_posts()): ?>
		<?php the_post();?>
		<?php $post_type = get_post_type();?>
		<div class="mdl-cell mdl-cell--12-col">
			<!-- posts -->
			<article class="<?php echo $post_type; ?>" itemscope itemtype="http://schema.org/Article">
				<?php if (has_post_thumbnail()): ?>
					<div class="<?php echo $post_type; ?>-thumb-image">
						<img itemprop="image" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="<?php the_title();?>" width="150" height="150">
					</div>
				<?php endif;?>
				<div class="<?php echo $post_type; ?>-content content">
					<header class="<?php echo $post_type; ?>-header header">
						<h3 class="<?php echo $post_type; ?>-name name" itemprop="name headline">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title();?></a>
						</h3>
					</header>
					<div class="<?php echo $post_type; ?>-excerpt excerpt" itemprop="description">
						<p><?php the_excerpt();?></p>
					</div>
					<footer class="<?php echo $post_type; ?>-meta meta">
						<ul>
							<li><a href="" rel="category tag"><?php the_category(',');?></a></li>
							<li><time datetime="<?php the_time('Y-m-d\TH:i:sP')?>" itemprop="datePublished" pubdate><?php the_date('Y/m/d');?></time></li>
						</ul>
					</footer>
				</div>
			</article>
			<!-- posts -->
		</div>
		<?php endwhile;?>
			<div class="mdl-cell mdl-cell--6-col"><?php previous_posts_link('《前頁');?></div>
			<?php Mxp_theme::mxp_theme_pre_render_link(get_previous_posts_link());?>
			<div class="mdl-cell mdl-cell--6-col"><?php next_posts_link('後頁》');?></div>
			<?php Mxp_theme::mxp_theme_pre_render_link(get_next_posts_link());?>
		<?php else: ?>
		<!-- 沒東西勒！ -->
		<div class="mdl-cell mdl-cell--12-col">
		<p>無相關內容呈現。</p>
		</div>
		<!-- 沒東西勒！ -->
		<?php endif;?>
	</div>
</div>
<div class="mdl-cell mdl-cell--3-col"></div>
</div>