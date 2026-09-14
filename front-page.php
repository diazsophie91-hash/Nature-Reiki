<?php get_header(); ?>


<!-- =========================
	CONTENU PRINCIPAL
========================== -->

<main class="accueil" id="main-content">


	<!-- =========================
		INTRODUCTION
	========================== -->

	<section class="intro">

		<div class="petit-titre">
			Choisissez
		</div>

		<h1>
			VOTRE UNIVERS
		</h1>


		<div class="ligne-decoration">

			<span class="ligne"></span>

			<div class="symboles-decoration">

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
					class="symbole-chene"
				>

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
					class="symbole-lotus"
				>

			</div>

			<span class="ligne"></span>

		</div>


		<p>
			Deux approches complémentaires pour se reconnecter<br>
			à soi, à la nature et à l’essentiel.
		</p>

	</section>



	<!-- =========================
		LES DEUX UNIVERS
	========================== -->

	<section class="univers">


		<!-- =========================
			GUIDE NATURE
		========================== -->

		<a
			href="<?php echo esc_url( home_url( '/accueil-guide-nature/' ) ); ?>"
			class="univers-box nature-box"
		>

			<div class="univers-symbole">

				<img
					src="
					<?php
					echo esc_url(
						nature_reiki_asset_url( 'images/chene.png' )
					);
					?>
					"
					alt="Chêne"
					loading="lazy"
					decoding="async"
				>

			</div>


			<h2>
				GUIDE NATURE
			</h2>


			<div class="petite-ligne">

				<span></span>

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


			<div class="mots">
				<strong>Balades&nbsp;&nbsp;•&nbsp;&nbsp;Cuisine sauvage&nbsp;&nbsp;•&nbsp;&nbsp;Animations</strong>
			</div>


			<p>
				Explorez, observez et émerveillez-vous<br>
				au cœur de la nature.
			</p>


			<span class="bouton">
				Découvrir
				<span>›</span>
			</span>

		</a>



		<!-- =========================
			REIKI
		========================== -->

		<a
			href="<?php echo esc_url( home_url( '/accueil-reiki/' ) ); ?>"
			class="univers-box reiki-box"
		>

			<div class="univers-symbole">

				<img
					src="
					<?php
					echo esc_url(
						nature_reiki_asset_url( 'images/arbre-vie.png' )
					);
					?>
					"
					alt="Arbre de vie"
					loading="lazy"
					decoding="async"
				>

			</div>


			<h2>
				REIKI
			</h2>


			<div class="petite-ligne">

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


			<div class="mots">
				<strong>Soins énergétiques</strong>
			</div>


			<p>
				Réharmonisation physique, émotionnelle,<br>
				mentale et spirituelle.
			</p>


			<span class="bouton">
				Découvrir
				<span>›</span>
			</span>

		</a>

	</section>



	<!-- =========================
		BANDEAU DU BAS
	========================== -->

	<div class="bas-page">

		<span class="coeur">
			<img
				src="
				<?php
				echo esc_url(
					nature_reiki_asset_url( 'images/coeur.png' )
				);
				?>
				"
				alt=""
				aria-hidden="true"
				loading="lazy"
				decoding="async"
			>
		</span>

		<span>
			Un même site, deux univers, une seule adresse
		</span>

		<span class="adresse">
			Nature-reiki.be
		</span>

	</div>


</main>


<?php get_footer(); ?>
