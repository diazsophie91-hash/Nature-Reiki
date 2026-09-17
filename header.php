<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">
	Aller au contenu principal
</a>

<?php
$is_reiki  = nature_reiki_is_reiki_context();
$is_nature = nature_reiki_is_nature_context();

if ( $is_reiki ) {
	$logo = 'images/logo-reiki-transparent.png';
} elseif ( $is_nature ) {
	$logo = 'images/logo-guide-nature-transparent.png';
} else {
	$logo = 'images/logo-nature-reiki-transparent.png';
}
?>


<header class="accueil-header">

<!-- LOGO -->
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">

	<img
		src="<?php echo esc_url( nature_reiki_asset_url( $logo ) ); ?>"
		alt="Nature & Reiki"
	>

</a>


<!-- SWITCH ENTRE LES DEUX UNIVERS + FB -->

<div class="header-actions">

	<div class="switch-univers">

		<!-- NATURE -->

		<a
			href="<?php echo esc_url( home_url( '/accueil-guide-nature/' ) ); ?>"
			class="switch-nature <?php echo $is_nature ? 'actif' : ''; ?>"
		>
			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.png' ) ); ?>"
				alt=""
				aria-hidden="true"
				class="switch-symbole"
			>
			Nature
		</a>


		<!-- FLÈCHE -->

		<span class="switch-icon" aria-hidden="true">
			↔
		</span>


		<!-- REIKI -->

		<a
			href="<?php echo esc_url( home_url( '/accueil-reiki/' ) ); ?>"
			class="switch-reiki <?php echo $is_reiki ? 'actif' : ''; ?>"
		>
			Reiki
			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.png' ) ); ?>"
				alt=""
				aria-hidden="true"
				class="switch-symbole"
			>
		</a>

	</div>


	<!-- FACEBOOK -->

	<a
		href="https://www.facebook.com/"
		class="facebook-link"
		target="_blank"
		rel="noopener noreferrer"
		aria-label="Facebook"
	>
		<img
			src="<?php echo esc_url( nature_reiki_asset_url( 'images/facebook.png' ) ); ?>"
			alt=""
			aria-hidden="true"
		>
	</a>

</div>

</header>
