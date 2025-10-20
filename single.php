<?php
/**
 * The template for displaying single posts.
 * Post type: post
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="content <?php echo esc_attr( apply_filters( 'bitski-wp-theme/class/container',
	'container-xl' ) ); ?> pt-4 pb-5">
	<!-- Content header: post title, thumbnail -->
	<header class="content-header mb-4">
		<h1 class="post-title"><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) {
			$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
			<img class="post-thumbnail img-fluid rounded mb-3" src="<?php echo esc_url( $thumbnail_url ); ?>"
			     alt="<?php the_title_attribute(); ?>" loading="lazy">
		<?php } ?>
	</header>

	<!-- Content body: post content -->
	<div class="content-body row">
		<div class="col-12">
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>