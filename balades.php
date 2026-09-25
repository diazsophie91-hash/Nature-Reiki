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
			Marcher, observer, comprendre<span class="sous-titre-point">.</span>
		</p>

		<div class="nature-ligne-decoration">

			<span></span>

			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.svg' ) ); ?>"
				alt=""
				aria-hidden="true"
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
				'titre'     => 'Sur les pas des Celtes à nos jours',
				'mention'   => '',
				'image'     => 'images/celte.svg',
				'variante'  => 'nature-carte--verte',
				'contenu'   => '<p>Depuis mon enfance, la nature a toujours occupé une place particulière dans ma vie. Les plantes, les arbres, les animaux, les oiseaux… tout ce qui compose le vivant a toujours éveillé ma curiosité.</p><p>Cette balade invite à marcher, observer et comprendre, en suivant les traces de ceux qui nous ont précédés et en découvrant l’histoire qui s’écrit autour de nous, entre terre et ciel.</p>',
			),
			array(
				'titre'     => 'Mon ami l’arbre',
				'mention'   => '',
				'image'     => 'images/chene.png',
				'variante'  => 'nature-carte--verte',
				'contenu'   => '<p>Les arbres, les plantes, les animaux, les oiseaux… tout ce qui compose le vivant a toujours éveillé ma curiosité. Dans cette balade, nous apprendrons à observer l’arbre autrement, à lire ses cicatrices, ses branches et sa présence dans le paysage.</p><p>L’arbre est un compagnon de route qui nous enseigne la patience, la résilience et le lien profond qui nous unit au vivant.</p>',
			),
			array(
				'titre'     => 'La forêt autrement',
				'mention'   => '',
				'image'     => 'images/miroir.png',
				'variante'  => 'nature-carte--brune',
				'contenu'   => '<p>La forêt est un lieu où l’on peut être au calme, s’émerveiller et simplement se sentir exister. Dans cette balade, nous apprendrons à l’observer autrement, à ralentir et à écouter ce qu’elle a à nous dire.</p><p>Chaque pas devient une rencontre avec le vivant, les plantes sauvages, les arbres et les animaux qui l’habitent.</p>',
			),
			array(
				'titre'     => 'Traces et indices en forêt',
				'mention'   => '',
				'image'     => 'images/trace.svg',
				'variante'  => 'nature-carte--brune',
				'contenu'   => '<p>La nature m’intéresse dans toute sa richesse : les plantes sauvages, les arbres, les animaux, les traces et indices, la géologie, l’écologie… mais aussi l’histoire, que j’aime particulièrement.</p><p>Dans cette balade, nous apprendrons à lire les traces, les indices et les signes discrets qui révèlent la présence de la vie dans la forêt.</p>',
			),
			array(
				'titre'     => 'Cuisine sauvage',
				'mention'   => '',
				'image'     => 'images/cuisine.png',
				'variante'  => 'nature-carte--bleue',
				'contenu'   => '<p>La nature m’intéresse dans toute sa richesse : les plantes sauvages, les arbres, les animaux, les traces et indices, la géologie, l’écologie… mais aussi l’histoire, que j’aime particulièrement.</p><p>Dans cette balade, nous apprendrons à reconnaître les plantes sauvages comestibles, à les observer et à les intégrer avec respect dans notre cuisine quotidienne.</p>',
			),
			array(
				'titre'     => 'Découverte carrières',
				'mention'   => '',
				'image'     => 'images/pierres.png',
				'variante'  => 'nature-carte--bleue',
				'contenu'   => '<p>La nature m’intéresse dans toute sa richesse : les plantes sauvages, les arbres, les animaux, les traces et indices, la géologie, l’écologie… mais aussi l’histoire, que j’aime particulièrement.</p><p>Dans cette balade, nous apprendrons à découvrir les carrières, à comprendre leur histoire, leur géologie et la manière dont elles participent à la richesse du paysage et de la biodiversité locale.</p>',
			),
		);
		?>

		<div class="nature-cartes">

			<?php foreach ( $balades as $balade_index => $balade ) : ?>

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

				<button
					type="button"
					class="nature-carte-en-savoir-plus"
					aria-expanded="false"
					aria-controls="nature-carte-details-<?php echo esc_attr( $balade_index ); ?>"
				>
					<span>En savoir plus</span>
					<span class="nature-carte-fleche" aria-hidden="true"></span>
				</button>

				<div class="nature-carte-details" id="nature-carte-details-<?php echo esc_attr( $balade_index ); ?>">
					<?php echo wp_kses_post( $balade['contenu'] ); ?>
				</div>

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
				'image'   => 'images/celte.jpg',
				'legende' => 'Sur les pas des Celtes à nos jours',
			),
			array(
				'image'   => 'images/ami-arbre.jpg',
				'legende' => 'Mon ami l’arbre',
			),
			array(
				'image'   => 'images/foret-autrement.png',
				'legende' => 'La forêt autrement',
			),
			array(
				'image'   => 'images/traces.jpg',
				'legende' => 'Traces et indices en forêt',
			),
			array(
				'image'   => 'images/cuisine.jpg',
				'legende' => 'Cuisine sauvage',
			),
			array(
				'image'   => 'images/carriere.jpg',
				'legende' => 'Découverte carrières',
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

						<figure class="nature-carrousel-figure">
							<img
								src="<?php echo esc_url( nature_reiki_asset_url( $diapositive['image'] ) ); ?>"
								alt="<?php echo esc_attr( $diapositive['legende'] ); ?>"
								loading="lazy"
								decoding="async"
							>
							<figcaption><?php echo esc_html( $diapositive['legende'] ); ?></figcaption>
						</figure>

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
