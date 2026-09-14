<?php
/**
 * Template Name: Me contacter
 */
get_header();
?>

<main class="page-me-contacter" id="main-content">


<!-- =========================
	HERO
========================= -->

<section class="reiki-hero">

	<h1>Me contacter</h1>

	<p>
		Une demande d’information ?
		Je vous invite à me contacter directement.
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


		<img
			src="
			<?php
			echo esc_url(
				nature_reiki_asset_url( 'images/feuille-chene.png' )
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
		MENU
	========================== -->

	<?php nature_reiki_display_menu(); ?>


	<!-- =========================
		COORDONNÉES
	========================== -->

	<section class="me-contacter-coordonnees">

		<div class="me-contacter-contenu">


			<!-- ADRESSE -->

			<article class="me-contacter-info">

				<div class="me-contacter-icone">
					<img
						src="
						<?php
						echo esc_url(
							nature_reiki_asset_url( 'images/localisation.png' )
						);
						?>
						"
						alt="Adresse"
						loading="lazy"
						decoding="async"
					>
				</div>

				<div class="me-contacter-info-texte">

					<h2>Adresse</h2>

					<p>
						<a
							href="https://www.google.com/maps/search/?api=1&query=Rue+du+Doyare+n%C2%B03%2C+4920+Aywaille"
							target="_blank"
							rel="noopener"
						>
							Rue du Doyare n°3,<br>4920 Aywaille
						</a>
					</p>

				</div>

			</article>


			<!-- E-MAIL -->

			<article class="me-contacter-info">

				<div class="me-contacter-icone">
					<img
						src="
						<?php
						echo esc_url(
							nature_reiki_asset_url( 'images/mail.png' )
						);
						?>
						"
						alt="E-mail"
						loading="lazy"
						decoding="async"
					>
				</div>

				<div class="me-contacter-info-texte">

					<h2>E-mail</h2>

					<p>
						<a href="mailto:tonadresse@email.be">
							tonadresse@email.be
						</a>
					</p>

				</div>

			</article>


			<!-- TÉLÉPHONE -->

			<article class="me-contacter-info">

				<div class="me-contacter-icone">
					<img
						src="
						<?php
						echo esc_url(
							nature_reiki_asset_url( 'images/smartphone.png' )
						);
						?>
						"
						alt="Téléphone"
						loading="lazy"
						decoding="async"
					>
				</div>

				<div class="me-contacter-info-texte">

					<h2>Téléphone</h2>

					<p>
						<a href="tel:+32497812183">
							+32 497 81 21 83
						</a>
					</p>

				</div>

			</article>


		</div>

	</section>


	<!-- =========================
		REIKI / GUIDE NATURE
	========================== -->

	<section class="me-contacter-univers">

		<div class="me-contacter-contenu">

			<div class="me-contacter-univers-grid">


				<!-- REIKI -->

				<article class="me-contacter-univers-card me-contacter-reiki">

					<div class="me-contacter-univers-symbole">

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


					</div>

					<h2>Reiki</h2>

					<p>
						Pour toute question concernant les séances
						et/ou sur une réservation.
					</p>

				</article>


				<!-- GUIDE NATURE -->

				<article class="me-contacter-univers-card me-contacter-nature">

					<div class="me-contacter-univers-symbole">

						<img
							src="
							<?php
							echo esc_url(
								nature_reiki_asset_url( 'images/feuille-chene.png' )
							);
							?>
							"
							alt=""
							aria-hidden="true"
							loading="lazy"
				decoding="async"
							>


					</div>

					<h2>Guide Nature</h2>

					<p>
						Pour toute question concernant les balades,
						animations, balades privées et/ou sur une réservation.
					</p>

				</article>


			</div>

		</div>

	</section>


</main>


<?php get_footer(); ?>
