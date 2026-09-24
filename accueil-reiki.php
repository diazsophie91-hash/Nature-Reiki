<?php
/*
Template Name: Accueil Reiki
*/
?>

<?php get_header(); ?>

<main class="page-reiki" id="main-content">

	<!-- 1. HERO -->
<section class="reiki-hero" aria-labelledby="reiki-titre">

	<h1 id="reiki-titre">Reiki</h1>

	<p>
		Un moment pour soi<span class="sous-titre-point">.</span>
	</p>

	<div class="reiki-ligne-decoration">

		<span></span>

		<img
			src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.svg' ) ); ?>"
			alt=""
			aria-hidden="true"
			loading="lazy"
			decoding="async"
		>

		<span></span>

	</div>


</section>

<?php nature_reiki_display_menu(); ?>


<?php
$bannieres = array(
	array(
		'section_class'   => 'reiki-qui-suis-je-section',
		'section_id'      => '',
		'aria_labelledby' => 'qui-suis-je-titre',
		'banniere_class'  => 'reiki-banniere-3',
		'decor_class'     => 'reiki-banniere-3-decor',
		'contenu_class'   => 'reiki-banniere-3-contenu',
		'bouton_class'    => 'reiki-banniere-3-bouton',
		'titre_id'        => 'qui-suis-je-titre',
		'titre'           => 'Qui suis-je ?',
		'description'     => 'Découvrez mon parcours et ce qui m’a menée jusqu’au Reiki.',
		'url'             => home_url( '/qui-suis-je/?univers=reiki' ),
		'bouton_text'     => 'Découvrir mon parcours →',
		'image'           => 'images/arbre-vie.png',
		'image_alt'       => '',
	),
	array(
		'section_class'   => 'reiki-definition',
		'section_id'      => 'reiki',
		'aria_labelledby' => 'reiki-definition-titre',
		'banniere_class'  => 'reiki-banniere-1',
		'decor_class'     => 'reiki-banniere-1-decor',
		'contenu_class'   => 'reiki-banniere-1-contenu',
		'bouton_class'    => 'reiki-banniere-1-bouton',
		'titre_id'        => 'reiki-definition-titre',
		'titre'           => 'Qu’est-ce que le Reiki ?',
		'description'     => 'Une courte introduction au Reiki.',
		'url'             => home_url( '/le-reiki/' ),
		'bouton_text'     => 'En savoir plus →',
		'image'           => 'images/lotus.svg',
		'image_alt'       => '',
	),
	array(
		'section_class'   => 'reiki-seances-section',
		'section_id'      => '',
		'aria_labelledby' => 'soins-reiki-titre',
		'banniere_class'  => 'reiki-banniere-2',
		'decor_class'     => 'reiki-banniere-2-decor',
		'contenu_class'   => 'reiki-banniere-2-contenu',
		'bouton_class'    => 'reiki-banniere-2-bouton',
		'titre_id'        => 'soins-reiki-titre',
		'titre'           => 'Les soins Reiki',
		'description'     => 'Un accompagnement personnalisé pour retrouver équilibre et harmonie.',
		'url'             => home_url( '/soins-reiki/' ),
		'bouton_text'     => 'Découvrir les soins →',
		'image'           => 'images/pendule.svg',
		'image_alt'       => 'Pendule de Reiki',
	),
);
?>

<?php foreach ( $bannieres as $banniere ) : ?>
<section class="<?php echo esc_attr( $banniere['section_class'] ); ?>"
	<?php
	if ( $banniere['section_id'] ) :
		?>
	id="<?php echo esc_attr( $banniere['section_id'] ); ?>"<?php endif; ?> aria-labelledby="<?php echo esc_attr( $banniere['aria_labelledby'] ); ?>">
	<div class="<?php echo esc_attr( $banniere['banniere_class'] ); ?>">
		<div class="<?php echo esc_attr( $banniere['decor_class'] ); ?>">
			<img
				src="<?php echo esc_url( nature_reiki_asset_url( $banniere['image'] ) ); ?>"
				alt="<?php echo esc_attr( $banniere['image_alt'] ); ?>"
				aria-hidden="true"
				loading="lazy"
				decoding="async"
			>
		</div>
		<div class="<?php echo esc_attr( $banniere['contenu_class'] ); ?>">
			<h2 id="<?php echo esc_attr( $banniere['titre_id'] ); ?>"><?php echo esc_html( $banniere['titre'] ); ?></h2>
			<p><?php echo esc_html( $banniere['description'] ); ?></p>
			<a href="<?php echo esc_url( $banniere['url'] ); ?>" class="<?php echo esc_attr( $banniere['bouton_class'] ); ?>">
				<?php echo esc_html( $banniere['bouton_text'] ); ?>
			</a>
		</div>
	</div>
</section>
<?php endforeach; ?>


</main>

<?php get_footer(); ?>
