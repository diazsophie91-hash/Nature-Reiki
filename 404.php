<?php
/**
 * Page d'erreur 404.
 *
 * @package Nature_Reiki
 */

get_header();
?>

<main class="page-fallback page-404" id="main-content">
	<div class="page-fallback-contenu">
		<section class="page-fallback-article" aria-labelledby="page-404-titre">
			<h1 id="page-404-titre">Page introuvable</h1>
			<p>La page demandée n'existe pas ou n'est plus disponible.</p>
			<a class="page-fallback-bouton" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				Retour à l'accueil
			</a>
		</section>
	</div>
</main>

<?php get_footer(); ?>
