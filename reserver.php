<?php
/**
 * Template Name: Réserver - Nature
 *
 * Page de réservation de l'univers Nature.
 * Le calendrier des dates sera intégré ultérieurement.
 *
 * @package Nature_Reiki
 */

get_header(); ?>


<main class="page-nature page-reserver" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="nature-hero" aria-labelledby="reserver-titre">

		<h1 id="reserver-titre">Réserver</h1>

		<p>
			Les balades prévues et leurs dates.
		</p>

		<div class="nature-ligne-decoration">

			<span></span>

			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.png' ) ); ?>"
				alt=""
				aria-hidden="true"
				loading="lazy"
				decoding="async"
			>

			<span></span>

		</div>

	</section>


	<!-- =========================
		MENU NATURE
	========================== -->

	<?php nature_reiki_display_menu(); ?>


	<!-- =========================
		RÉSERVATION
		CALENDRIER À INTÉGRER PLUS TARD
	========================== -->

	<section class="nature-reserver">

		<div class="nature-reserver-contenu">

			<p>
				Le calendrier des balades est à venir. En attendant, veuillez
				<a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>">
					me contacter par e-mail
				</a>
				afin de connaître les prochaines dates et réserver votre place, merci.
			</p>

		</div>

	</section>


	<!-- =========================
		MENTION
	========================== -->

	<div class="nature-mention">
		<p>
			Les balades se déroulent en extérieur et dépendent des conditions météorologiques. En cas de météo défavorable, une balade peut être reportée.
		</p>
	</div>


</main>


<?php get_footer(); ?>
