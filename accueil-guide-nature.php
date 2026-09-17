<?php
/**
 * Template Name: Accueil Guide Nature
 *
 * Page d'accueil de l'univers Nature.
 * Structure calquée sur accueil-reiki.php (hero, menu, bannières).
 *
 * @package Nature_Reiki
 */

get_header(); ?>


<main class="page-nature page-accueil-guide-nature" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="nature-hero" aria-labelledby="nature-titre">

		<h1 id="nature-titre">Guide Nature</h1>

		<p>
			Explorer, observer, s’émerveiller.
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
		BANNIÈRES
	========================== -->

	<?php
	$bannieres = array(
		array(
			'section_class' => 'nature-section',
			'variante'      => 'nature-banniere--verte',
			'titre_id'      => 'nature-qui-suis-je-titre',
			'titre'         => 'Qui suis-je ?',
			'description'   => 'Découvrez mon parcours et mon lien à la nature.',
			'url'           => home_url( '/qui-suis-je/?univers=nature' ),
			'bouton_text'   => 'Découvrir mon parcours →',
			'image'         => 'images/arbre-vie.png',
		),
		array(
			'section_class' => 'nature-section',
			'variante'      => 'nature-banniere--brune',
			'titre_id'      => 'nature-balades-titre',
			'titre'         => 'Les balades',
			'description'   => 'Des sorties pour observer, reconnaître et goûter la nature qui nous entoure.',
			'url'           => home_url( '/balades/' ),
			'bouton_text'   => 'Découvrir les balades →',
			'image'         => 'images/chene.png',
		),
		array(
			'section_class' => 'nature-section',
			'variante'      => 'nature-banniere--bleue',
			'titre_id'      => 'nature-animations-titre',
			'titre'         => 'Les animations',
			'description'   => 'Des animations sur mesure pour les familles, les écoles, les entreprises et les groupes privés.',
			'url'           => home_url( '/animations/' ),
			'bouton_text'   => 'Découvrir les animations →',
			'image'         => 'images/feuille-chene.png',
		),
		array(
			'section_class' => 'nature-section',
			'variante'      => 'nature-banniere--verte',
			'titre_id'      => 'nature-a-venir-titre',
			'titre'         => 'À venir',
			'description'   => 'Les prochains thèmes en préparation pour enrichir les sorties.',
			'url'           => home_url( '/a-venir/' ),
			'bouton_text'   => 'Voir les projets →',
			'image'         => 'images/chene.png',
		),
	);
	?>

	<?php foreach ( $bannieres as $banniere ) : ?>
	<section class="<?php echo esc_attr( $banniere['section_class'] ); ?>" aria-labelledby="<?php echo esc_attr( $banniere['titre_id'] ); ?>">

		<div class="nature-banniere <?php echo esc_attr( $banniere['variante'] ); ?>">

			<div class="nature-banniere-decor">
				<img
					src="<?php echo esc_url( nature_reiki_asset_url( $banniere['image'] ) ); ?>"
					alt=""
					aria-hidden="true"
					loading="lazy"
					decoding="async"
				>
			</div>

			<div class="nature-banniere-contenu">

				<h2 id="<?php echo esc_attr( $banniere['titre_id'] ); ?>">
					<?php echo esc_html( $banniere['titre'] ); ?>
				</h2>

				<p><?php echo esc_html( $banniere['description'] ); ?></p>

				<a href="<?php echo esc_url( $banniere['url'] ); ?>" class="nature-banniere-bouton">
					<?php echo esc_html( $banniere['bouton_text'] ); ?>
				</a>

			</div>

		</div>

	</section>
	<?php endforeach; ?>


	<!-- =========================
		APPEL À L'ACTION
	========================== -->

	<section class="nature-cta" aria-labelledby="nature-cta-titre">

		<div class="nature-cta-interieur">

			<h2 id="nature-cta-titre">Envie de partir en balade ?</h2>

			<div class="nature-cta-boutons">

				<a href="<?php echo esc_url( home_url( '/reserver/' ) ); ?>" class="nature-bouton">
					Réserver
				</a>

				<a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>" class="nature-bouton nature-bouton--secondaire">
					Me contacter
				</a>

			</div>

		</div>

	</section>


</main>


<?php get_footer(); ?>
