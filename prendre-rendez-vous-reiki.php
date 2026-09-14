<?php
/*
Template Name: Prendre rendez-vous — Reiki
*/
?>

<?php get_header(); ?>


<main class="page-reiki page-prendre-rendez-vous-reiki" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="reiki-hero">

		<h1>Prendre rendez-vous</h1>

		<p>
			Réservez votre soin Reiki.
		</p>

		<div class="reiki-ligne-decoration">

			<span></span>

			<img
				src="
				<?php
				echo esc_url(
					nature_reiki_asset_url( 'images/lotus.png' )
				);
				?>
				"
				alt=""
				aria-hidden="true"
				loading="lazy"
				decoding="async"
			>

			<span></span>

		</div>

	</section>


	<!-- =========================
		MENU REIKI
	========================== -->

	<?php nature_reiki_display_menu(); ?>


<!-- =========================
	RENDEZ-VOUS REIKI
	CALENDRIER À INTÉGRER PLUS TARD
========================= -->

<section class="prendre-rendez-vous-reiki">

	<div class="prendre-rendez-vous-reiki-contenu">

<p>
	Page en construction, veuillez
<a href="
<?php
echo esc_url(
	home_url( '/me-contacter/?univers=reiki' )
);
?>
">
		me contacter par e-mail
	</a>
	afin de prendre rendez-vous, merci.
</p>

	</div>

</section>


	<!-- =========================
		MENTION LÉGALE
	========================== -->

	<div class="le-reiki-mention">
		<p>
			Le Reiki est une pratique complémentaire de bien-être et ne se substitue en aucun cas à un avis médical, à un diagnostic ou à un traitement médical. En cas de problème de santé, il est important de consulter un professionnel de santé.
		</p>
	</div>


</main>


<?php get_footer(); ?>
