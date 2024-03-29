<?php get_header(); ?>

<?php
	// get options
	$pinthis_banner_position_1 = get_option('pbpanel_banner_position_1');
	$pinthis_banner_position_2 = get_option('pbpanel_banner_position_2');
?>

<section id="content">
	<div class="container clearfix">
		<?php if (strlen($pinthis_banner_position_1) > 0) { ?>
		<div class="banner banner-position-1">
			<?php echo html_entity_decode(stripslashes_deep($pinthis_banner_position_1), ENT_QUOTES); ?>	
		</div>
		<?php } ?>
		<div class="postWrap">
			<div <?php post_class(); ?>>
				<div class="contentbox">
					<?php while (have_posts()) { the_post(); ?>
					<?php pinthis_setPostViews(get_the_ID()); ?>
					<h3 class="title-1 border-color-1"><?php the_title(); ?></h3>
					<?php if (has_post_thumbnail()) { ?>
						<p class="featured-image">
							<?php 
								$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'pt-single');
							?>
							<?php if ($img[0] != '') { ?>
							<img src="<?php echo $img[0]; ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" alt="<?php the_title(); ?>">
							<?php } else {
								the_post_thumbnail('full');	
							} ?>
						</p>
					<?php } ?>
					<div class="metabar data clearfix">
						<ul class="postmetas">
							<li class="tooltip" title="<?php echo __('Post date', 'pinthis'); ?>"><span class="icon-post-date-2"><?php echo get_the_date('d.m.Y'); ?></span></li>
							<li><span class="icon-author"><?php the_author_posts_link(); ?></span></li>
							<li class="tooltip" title="<?php echo __('Total comments', 'pinthis'); ?>"><span class="icon-total-comments-2"><?php comments_number('0', '1', '%'); ?></span></li>
						</ul>
						<ul class="social-media-icons clearfix">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="border-color-3 icon-facebook tooltip" title="<?php echo __('Share on Facebook', 'pinthis'); ?>" target="_blank"><?php echo __('Facebook', 'pinthis'); ?></a></li>
							<li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="border-color-1 icon-gplus tooltip" title="<?php echo __('Share on Google+', 'pinthis'); ?>" target="_blank"><?php echo __('Google+', 'pinthis'); ?></a></li>
							<li><a href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" class="border-color-4 icon-twitter tooltip" title="<?php echo __('Share on Twitter', 'pinthis'); ?>" target="_blank"><?php echo __('Twitter', 'pinthis'); ?></a></li>
						</ul>
					</div>
					<?php if (strlen($pinthis_banner_position_2) > 0) { ?>
					<div class="banner banner-position-2">
						<?php echo html_entity_decode(stripslashes_deep($pinthis_banner_position_2), ENT_QUOTES); ?>	
					</div>
					<?php } ?>
					<div class="textbox clearfix">
						<?php the_content(); ?>
					</div>
					<?php wp_link_pages(array(
							'before' => '<div class="page-links">' . __('Pages:&nbsp;', 'pinthis' ), 
							'after' => '</div>',
							'link_before'      => '<span class="page-num">',
							'link_after'       => '</span>',
						)); 
					?>
					<?php comments_template(); ?>
					<?php } ?>	
				</div>
			</div>
		</div>
		<aside class="sidebar">
			<?php if (is_active_sidebar('page-sidebar')) { ?>
				<?php dynamic_sidebar('page-sidebar'); ?>
			<?php } else { ?>
				<div class="contentbox">
					<h4 class="title-1 border-color-2"><?php echo __('Meta', 'pinthis'); ?></h4>			
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div>
			<?php } ?>
		</aside>
	</div>
</section>

<?php get_footer(); ?>