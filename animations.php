<?php
/**
 * Template Name: Animations - Nature
 *
 * Animations nature proposées aux familles, écoles, entreprises
 * et groupes privés.
 *
 * @package Nature_Reiki
 */

get_header(); ?>


<main class="page-nature page-animations" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="nature-hero" aria-labelledby="animations-titre">

		<h1 id="animations-titre">Animations</h1>

		<p>
			Découvrir la nature, ensemble.
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
				Les animations sont construites avec vous, en fonction du public, de la
				durée souhaitée et du lieu. Chaque formule s’adapte à l’âge des
				participants et à la saison.
			</p>

			<p class="nature-disponibilite">
				Disponible à partir de juin 2027.
			</p>

		</div>

	</section>


	<!-- =========================
		LES PUBLICS
	========================== -->

	<section class="nature-section" aria-labelledby="animations-publics-titre">

		<h2 id="animations-publics-titre" class="nature-titre-section">
			Pour qui ?
		</h2>

		<?php
		$publics = array(
			array(
				'titre'       => 'Groupes privés',
				'description' => 'Une animation sur mesure pour un groupe constitué : famille, amis, association ou occasion particulière.',
				'image'       => 'images/feuille-chene.png',
				'variante'    => 'nature-carte--verte',
			),
			array(
				'titre'       => 'Écoles',
				'description' => 'Une animation adaptée au niveau de la classe, en lien avec le milieu naturel proche de l’école.',
				'image'       => 'images/feuille-chene.png',
				'variante'    => 'nature-carte--bleue',
			),
			array(
				'titre'       => 'Entreprises',
				'description' => 'Un temps en extérieur pour souffler et se retrouver autrement, autour de la découverte du vivant.',
				'image'       => 'images/chene.png',
				'variante'    => 'nature-carte--brune',
			),
		);
		?>

		<div class="nature-cartes">

			<?php foreach ( $publics as $public ) : ?>

			<article class="nature-carte <?php echo esc_attr( $public['variante'] ); ?>">

				<div class="nature-carte-symbole">
					<img
						src="<?php echo esc_url( nature_reiki_asset_url( $public['image'] ) ); ?>"
						alt=""
						aria-hidden="true"
						loading="lazy"
						decoding="async"
					>
				</div>

				<h3><?php echo esc_html( $public['titre'] ); ?></h3>

				<p class="nature-carte-texte">
					<?php echo esc_html( $public['description'] ); ?>
				</p>

			</article>

			<?php endforeach; ?>

		</div>

	</section>


	<!-- =========================
		CONDITIONS
	========================== -->

	<section class="nature-section" aria-labelledby="animations-conditions-titre">

		<div class="nature-encart nature-encart--bleu">

			<h2 id="animations-conditions-titre">Conditions</h2>

			<p>
				Les animations sont proposées sur devis et réservation. Le contenu, la
				durée et le tarif sont définis ensemble, selon le public et le lieu
				choisis.
			</p>

			<p class="nature-encart-mention">
				Disponible à partir de juin 2027.
			</p>

			<a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>" class="nature-bouton">
				Demander un devis
			</a>

		</div>

	</section>


</main>


<?php get_footer(); ?>
