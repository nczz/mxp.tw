<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--3-col">
	<?php if (is_active_sidebar('sidebar-l')): ?>
		<div class="widget-area">
			<?php dynamic_sidebar('sidebar-l');?>
		</div><!-- .widget-area -->
	<?php endif;?>
	</div>
	<div class="mdl-cell mdl-cell--6-col">
	<div class="mdl-grid">
		<?php if (have_posts()): ?>
		<?php while (have_posts()): ?>
		<?php the_post();?>
		<?php $post_type = get_post_type();?>
		<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
			<!-- posts -->
			<article class="<?php echo $post_type; ?>" itemscope itemtype="http://schema.org/Article">
				<?php if (has_post_thumbnail()): ?>
					<div class="<?php echo $post_type; ?>-thumb-image" style="display: none">
						<img itemprop="image" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="<?php the_title();?>" width="150" height="150">
					</div>
					<style>
					.post-<?php the_ID();?>>.mdl-card__title {
						height: 176px;background: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>') center / cover;
					}
					</style>
				<?php endif;?>
				<div class="<?php echo $post_type; ?>-content content">
					<header class="<?php echo $post_type; ?>-header header post-<?php the_ID();?>">
					<div class="mdl-card__title">
						<h2 class="<?php echo $post_type; ?>-name name mdl-card__title-text" itemprop="name headline">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title();?></a>
						</h2>
						</div>
					</header>
					<div class="<?php echo $post_type; ?>-excerpt excerpt" itemprop="description">
					<div class="mdl-card__supporting-text">
						<p><?php the_excerpt();?></p>
						</div>
					</div>
					<footer class="<?php echo $post_type; ?>-meta meta">
					<div class="mdl-card__actions mdl-card--border">
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					      Meta
					    </a>
					 </div>
						<ul style="display:none">
							<li><a href="" rel="category tag"><?php the_category(', ');?></a></li>
							<li><time datetime="<?php the_time('Y-m-d\TH:i:sP')?>" itemprop="datePublished" pubdate><?php the_date('Y/m/d');?></time></li>
						</ul>
					</footer>
					<div class="mdl-card__menu">
					    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
					      <i class="material-icons">share</i>
					    </button>
					</div>
				</div>
			</article>
			<!-- posts -->
		</div>
		<?php endwhile;?>
			<div class="mdl-cell mdl-cell--6-col"><?php previous_posts_link('《前頁');?></div>
			<?php Mxp_theme::mxp_theme_pre_render_link(get_previous_posts_link());?>
			<div class="mdl-cell mdl-cell--6-col"><?php next_posts_link('後頁》');?></div>
			<?php Mxp_theme::mxp_theme_pre_render_link(get_next_posts_link());?>
			<!--Card-->
			<!--Card-->
		<?php else: ?>
		<!-- 沒東西勒！ -->
		<div class="mdl-cell mdl-cell--12-col">
		<p>無相關內容呈現。</p>
		</div>
		<!-- 沒東西勒！ -->
		<?php endif;?>
	</div>
</div>
<div class="mdl-cell mdl-cell--3-col">
	<?php if (is_active_sidebar('sidebar-r')): ?>
		<div class="widget-area">
			<?php dynamic_sidebar('sidebar-r');?>
		</div><!-- .widget-area -->
	<?php endif;?>
</div>
</div>