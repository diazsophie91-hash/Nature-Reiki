<?php
/*
Template Name: Réserver - Nature
*
* Page de réservation pour l'univers Nature.
* À compléter ultérieurement.
*/
?>
<?php get_header(); ?>

<main class="page-nature page-reserver" id="main-content">
	<section class="reiki-hero">
		<h1>Réserver</h1>
		<p>Réservez votre expérience Nature.</p>
		<div class="reiki-ligne-decoration">
			<span></span>
			<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.png' ) ); ?>" alt="">
			<span></span>
		</div>
	</section>

	<?php nature_reiki_display_menu(); ?>

	<section class="reserver-section">
		<div class="reserver-contenu">
			<p>Page en construction, veuillez <a href="/me-contacter/?univers=nature">me contacter par e-mail</a> afin de prendre rendez-vous, merci.</p>
		</div>
	</section>
</main>

<?php get_footer(); ?>
