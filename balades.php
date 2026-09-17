<?php
/**
 * Template Name: Balades - Nature
 *
 * Présentation des balades de l'univers Nature.
 *
 * @package Nature_Reiki
 */

get_header(); ?>


<main class="page-nature page-balades" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="nature-hero" aria-labelledby="balades-titre">

		<h1 id="balades-titre">Balades</h1>

		<p>
			Marcher, observer, comprendre.
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
				Chaque balade est un temps de découverte, à mon rythme et au vôtre : on
				observe, on écoute, on touche, on goûte parfois. Les thèmes ci-dessous
				sont proposés au fil des saisons.
			</p>

		</div>

	</section>


	<!-- =========================
		LES SIX BALADES
	========================== -->

	<section class="nature-section" aria-labelledby="balades-liste-titre">

		<h2 id="balades-liste-titre" class="nature-titre-section">
			Les balades proposées
		</h2>

		<?php
		/*
		 * Les six balades proposées.
		 *
		 * Seuls les intitulés définis sont utilisés ici : aucune description
		 * ni saison n'est ajoutée tant que les textes ne sont pas fournis.
		 * La clé 'mention' reste vide sauf information à afficher.
		 */
		$balades = array(
			array(
				'titre'    => 'Sur les pas des Celtes à nos jours',
				'mention'  => '',
				'image'    => 'images/chene.png',
				'variante' => 'nature-carte--verte',
			),
			array(
				'titre'    => 'Mon ami l’arbre',
				'mention'  => '',
				'image'    => 'images/chene.png',
				'variante' => 'nature-carte--verte',
			),
			array(
				'titre'    => 'La forêt autrement',
				'mention'  => '',
				'image'    => 'images/feuille-chene.png',
				'variante' => 'nature-carte--brune',
			),
			array(
				'titre'    => 'Traces et indices en forêt',
				'mention'  => '',
				'image'    => 'images/feuille-chene.png',
				'variante' => 'nature-carte--brune',
			),
			array(
				'titre'    => 'Cuisine sauvage',
				'mention'  => '',
				'image'    => 'images/feuille-chene.png',
				'variante' => 'nature-carte--bleue',
			),
			array(
				'titre'    => 'Découverte carrières',
				'mention'  => 'Cette balade nécessite d’être guide carrière.',
				'image'    => 'images/chene.png',
				'variante' => 'nature-carte--bleue',
			),
		);
		?>

		<div class="nature-cartes">

			<?php foreach ( $balades as $balade ) : ?>

			<article class="nature-carte <?php echo esc_attr( $balade['variante'] ); ?>">

				<div class="nature-carte-symbole">
					<img
						src="<?php echo esc_url( nature_reiki_asset_url( $balade['image'] ) ); ?>"
						alt=""
						aria-hidden="true"
						loading="lazy"
						decoding="async"
					>
				</div>

				<h3><?php echo esc_html( $balade['titre'] ); ?></h3>

				<?php if ( '' !== $balade['mention'] ) : ?>
				<p class="nature-carte-etiquette">
					<?php echo esc_html( $balade['mention'] ); ?>
				</p>
				<?php endif; ?>

			</article>

			<?php endforeach; ?>

		</div>

		<div class="nature-section-action">

			<a href="<?php echo esc_url( home_url( '/reserver/' ) ); ?>" class="nature-bouton nature-bouton--large">
				Voir les balades prévues &amp; réserver
			</a>

		</div>

	</section>


	<!-- =========================
		BALADES PRIVÉES
	========================== -->

	<section class="nature-section" aria-labelledby="balades-privees-titre">

		<div class="nature-encart nature-encart--brun">

			<h2 id="balades-privees-titre">Balades privées</h2>

			<p>
				Vous préférez partir en petit comité ? Les balades peuvent être organisées
				en privé, pour un groupe d’amis, une famille ou une occasion particulière.
				Le thème, la durée et le lieu sont définis ensemble.
			</p>

			<p class="nature-encart-mention">
				Les balades privées se font sur devis et réservation.
			</p>

			<a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>" class="nature-bouton">
				Demander un devis
			</a>

		</div>

	</section>


	<!-- =========================
		CARROUSEL
	========================== -->

	<section class="nature-section" aria-labelledby="balades-carrousel-titre">

		<h2 id="balades-carrousel-titre" class="nature-titre-section">
			Au fil des balades
		</h2>

		<?php
		$diapositives = array(
			array(
				'texte'   => 'On avance doucement : c’est en ralentissant que l’on remarque le plus de choses.',
				'legende' => 'Le rythme de la balade',
			),
			array(
				'texte'   => 'Reconnaître une plante, c’est d’abord la regarder longuement, sous tous les angles.',
				'legende' => 'Observer avant de nommer',
			),
			array(
				'texte'   => 'Une cueillette se fait avec mesure : on ne prélève jamais tout ce que l’on trouve.',
				'legende' => 'Cueillir avec respect',
			),
			array(
				'texte'   => 'Chaque saison redessine le même chemin : rien n’est jamais tout à fait pareil.',
				'legende' => 'Revenir au fil des saisons',
			),
		);

		$total_diapositives = count( $diapositives );
		?>

		<div class="nature-carrousel" data-nature-carrousel>

			<div class="nature-carrousel-fenetre">

				<ul class="nature-carrousel-piste" data-nature-carrousel-piste>

					<?php foreach ( $diapositives as $index => $diapositive ) : ?>

					<li
						class="nature-carrousel-diapositive"
						data-nature-carrousel-diapositive
						role="group"
						aria-roledescription="diapositive"
						aria-label="<?php echo esc_attr( sprintf( '%1$d sur %2$d', $index + 1, $total_diapositives ) ); ?>"
					>

						<blockquote>
							<p><?php echo esc_html( $diapositive['texte'] ); ?></p>
							<footer><?php echo esc_html( $diapositive['legende'] ); ?></footer>
						</blockquote>

					</li>

					<?php endforeach; ?>

				</ul>

			</div>

			<div class="nature-carrousel-commandes">

				<button
					type="button"
					class="nature-carrousel-fleche nature-carrousel-fleche--precedent"
					data-nature-carrousel-precedent
					aria-label="Diapositive précédente"
				>
					<span aria-hidden="true"></span>
				</button>

				<div class="nature-carrousel-puces" data-nature-carrousel-puces></div>

				<button
					type="button"
					class="nature-carrousel-fleche nature-carrousel-fleche--suivant"
					data-nature-carrousel-suivant
					aria-label="Diapositive suivante"
				>
					<span aria-hidden="true"></span>
				</button>

			</div>

		</div>

	</section>


</main>


<?php get_footer(); ?>
