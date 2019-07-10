<?php
	// get options
	$pinthis_pinbox_soc_icons = get_option('pbpanel_pinbox_soc_icons');
	$pinthis_pinbox_show_comments = get_option('pbpanel_pinbox_show_comments');
	$pinthis_pinbox_show_postdate = get_option('pbpanel_pinbox_show_postdate');
?>

<article class="pinbox">
	<div <?php post_class(); ?>>
		<?php $pinthis_googleadsense_code = get_post_meta($post->ID, 'googleadsense_code', true); ?>
		<?php if (strlen($pinthis_googleadsense_code) > 0) { ?>
			<div class="banner banner-position-3">
				<?php echo html_entity_decode(stripslashes_deep($pinthis_googleadsense_code), ENT_QUOTES); ?>
			</div>
		<?php } else { ?>
		<?php if (is_sticky()) { ?>
			<span class="ribbon"><?php echo __('Sticky', 'pinthis'); ?></span>
			<?php } ?>
			<?php if ($pinthis_pinbox_soc_icons == 1) { ?>
			<div class="top-bar">
				<ul class="social-media-icons clearfix">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" class="border-color-3 icon-facebook tooltip" title="<?php echo __('Share on Facebook', 'pinthis'); ?>" target="_blank"><?php echo __('Facebook', 'pinthis'); ?></a></li>
					<li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="border-color-1 icon-gplus tooltip" title="<?php echo __('Share on Google+', 'pinthis'); ?>" target="_blank"><?php echo __('Google+', 'pinthis'); ?></a></li>
					<li><a href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" class="border-color-4 icon-twitter tooltip" title="<?php echo __('Share on Twitter', 'pinthis'); ?>" target="_blank"><?php echo __('Twitter', 'pinthis'); ?></a></li>
				</ul>
			</div>
			<?php } ?>
			<div class="preview">
				<p class="thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if (has_post_thumbnail()) { ?>
							<?php
							$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'pt-pinbox');
							if ($img[0] != '') { ?>
								<img src="<?php echo $img[0]; ?>" width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>" alt="<?php the_title(); ?>">
							<?php
							} else {
								the_post_thumbnail('medium');
							}
						?>
						<?php } else { ?>
							<img src="<?php echo pinthis_get_skin_src(); ?>/images/no-image.png" width="236" height="236" alt="<?php the_title(); ?>">
						<?php } ?>
					</a>
				</p>
			</div>
			<div class="title">
				<h2 class="title-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="excerpt">
				<?php pinthis_excerpt(20); ?>
			</div>
			<div class="meta-data">
				<ul class="clearfix">
					<?php if ($pinthis_pinbox_show_comments == 1 || $pinthis_pinbox_show_postdate == 1) { ?>
						<?php if ($pinthis_pinbox_show_comments == 1) { ?>
						<li class="border-color-1 tooltip <?php if ($pinthis_pinbox_show_postdate != 1) { ?>full<?php } ?>" title="<?php echo __('Total comments', 'pinthis'); ?>">
							<?php if ($pinthis_pinbox_show_comments == 1) { ?>
								<span class="icon-total-comments"><?php comments_number('0', '1', '%'); ?></span>
							<?php } ?>
						</li>
						<?php } ?>
						<?php if ($pinthis_pinbox_show_postdate == 1) { ?>
						<li class="border-color-2 tooltip <?php if ($pinthis_pinbox_show_comments != 1) { ?>full<?php } ?>" title="<?php echo __('Post date', 'pinthis'); ?>">
							<?php if ($pinthis_pinbox_show_postdate == 1) { ?>
								<span class="icon-post-date"><?php echo get_the_date('d.m.y'); ?></span>
							<?php } ?>
						</li>
						<?php } ?>
					<?php } else { ?>
					<li class="border-color-1 empty">&nbsp;</li>
					<li class="border-color-2 empty">&nbsp;</li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</article>