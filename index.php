<?php
/**
 * Index principal du thème.
 *
 * Fallback WordPress lorsque aucun template plus spécifique n'est disponible.
 *
 * @package Nature_Reiki
 */

get_header();
?>

<main class="page-fallback" id="main-content">
	<div class="page-fallback-contenu">

	<?php if ( have_posts() ) : ?>

		<?php if ( is_search() ) : ?>
			<h1>Résultats de recherche</h1>
		<?php elseif ( ! is_singular() ) : ?>
			<h1>Contenu</h1>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<article class="page-fallback-article">
				<?php if ( is_singular() ) : ?>
					<h1><?php the_title(); ?></h1>
				<?php else : ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>

				<div class="page-fallback-texte">
					<?php if ( is_singular() ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
				</div>
			</article>
		<?php endwhile; ?>

	<?php else : ?>

		<h1>Contenu introuvable</h1>
		<p>Cette page ne contient actuellement aucun contenu à afficher.</p>

	<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
