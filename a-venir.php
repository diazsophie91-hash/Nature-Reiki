<?php
/**
 * Template Name: À venir - Nature
 *
 * Thèmes de balades en préparation pour l'univers Nature.
 *
 * @package Nature_Reiki
 */

get_header(); ?>


<main class="page-nature page-a-venir" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="nature-hero" aria-labelledby="a-venir-titre">

		<h1 id="a-venir-titre">À venir</h1>

		<p>
			Les balades en préparation.
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
		INTRODUCTION
	========================== -->

	<section class="nature-section nature-section--texte">

		<div class="nature-intro">

			<p>
				Deux nouveaux thèmes de balades sont en préparation. Ils ne sont pas encore
				proposés au calendrier : cette page sera mise à jour dès que les dates
				seront connues.
			</p>

		</div>

	</section>


	<!-- =========================
		LES PROJETS
	========================== -->

	<section class="nature-section" aria-labelledby="a-venir-projets-titre">

		<h2 id="a-venir-projets-titre" class="nature-titre-section">
			En préparation
		</h2>

		<?php
		$projets = array(
			array(
				'titre'       => 'Balade champignons',
				'description' => 'Une sortie consacrée à l’observation des champignons : où les chercher, comment les regarder et quel rôle ils jouent dans la forêt.',
				'image'       => 'images/chene.png',
				'variante'    => 'nature-carte--brune',
			),
			array(
				'titre'       => 'Balade dans les vignes',
				'description' => 'Une balade au fil des vignes, pour découvrir ce milieu particulier, son paysage et la vie qui s’y installe.',
				'image'       => 'images/feuille-chene.png',
				'variante'    => 'nature-carte--bleue',
			),
		);
		?>

		<div class="nature-cartes nature-cartes--duo">

			<?php foreach ( $projets as $projet ) : ?>

			<article class="nature-carte <?php echo esc_attr( $projet['variante'] ); ?>">

				<div class="nature-carte-symbole">
					<img
						src="<?php echo esc_url( nature_reiki_asset_url( $projet['image'] ) ); ?>"
						alt=""
						aria-hidden="true"
						loading="lazy"
						decoding="async"
					>
				</div>

				<p class="nature-carte-etiquette">En préparation</p>

				<h3><?php echo esc_html( $projet['titre'] ); ?></h3>

				<p class="nature-carte-texte">
					<?php echo esc_html( $projet['description'] ); ?>
				</p>

			</article>

			<?php endforeach; ?>

		</div>

	</section>


	<!-- =========================
		APPEL À L'ACTION
	========================== -->

	<section class="nature-cta" aria-labelledby="a-venir-cta-titre">

		<div class="nature-cta-interieur">

			<h2 id="a-venir-cta-titre">Envie d’être prévenu·e ?</h2>

			<p>
				Faites-moi signe : je vous informerai dès que ces balades seront programmées.
			</p>

			<div class="nature-cta-boutons">

				<a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>" class="nature-bouton">
					Me contacter
				</a>

				<a href="<?php echo esc_url( home_url( '/balades/' ) ); ?>" class="nature-bouton nature-bouton--secondaire">
					Voir les balades actuelles
				</a>

			</div>

		</div>

	</section>


</main>


<?php get_footer(); ?>
