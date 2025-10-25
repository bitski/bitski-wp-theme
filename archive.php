<?php
/**
 * Template for displaying archive pages.
 * Post type: post, custom post types
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
	<!-- Content header -->
	<header class="content-header mb-4">
		<h1 class="archive-title"><?php the_archive_title(); ?></h1>
		<p class="archive-description"><?php the_archive_description(); ?></p>
	</header>

	<?php if ( have_posts() ) {
		$found_posts = $wp_query->found_posts;
		$posts_per_page = get_option( 'posts_per_page' );
		?>
		<!-- Content body: post list -->
		<section class="content-body row g-4<?php
		if ( paginate_links() ) {
			echo ' mb-4';
		} ?>">
			<?php
			while ( have_posts() ) {
				the_post(); ?>
				<div class="col-12<?php
				if ( $found_posts > 1 && $posts_per_page > 1 ) { ?>
                    col-lg-6
                <?php } ?>">
					<?php get_template_part( 'templates/components/article/card' ); ?>
				</div>
			<?php } ?>
		</section>
		<?php
		get_template_part( 'templates/components/pagination' );
	} else { ?>
		<!-- Content body: no posts -->
		<section class="content-body no-posts">
			<header class="no-posts-header alert alert-primary mb-4">
                <?php get_template_part( 'templates/components/post/category-badges' ); ?>
                <h2 class="no-posts-title"><?php echo esc_html( 'Keine Beiträge gefunden!', 'bitski-wp-theme' ); ?></h2>
			</header>
			<div class="no-posts-content">
				<p class="alert alert-info mb-4"><?php echo esc_html( 'Zurzeit sind keine Beiträge verfügbar. Bitte besuche uns später wieder oder nutze die Suche:',
						'bitski-wp-theme' ); ?></p>
				<?php get_template_part( 'templates/components/search/form', null, array( 'class' => 'mb-4' ) ); ?>
			</div>
		</section>
	<?php } ?>
</main>

<?php get_footer(); ?>
