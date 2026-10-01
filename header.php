<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

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

if ( 'images/logo-reiki-transparent.png' === $logo ) {
	$logo_width  = 1203;
	$logo_height = 1307;
} elseif ( 'images/logo-guide-nature-transparent.png' === $logo ) {
	$logo_width  = 1210;
	$logo_height = 1300;
} else {
	$logo_width  = 1230;
	$logo_height = 1278;
}
?>


<header class="accueil-header">

<!-- LOGO -->
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">

	<img
		src="<?php echo esc_url( nature_reiki_asset_url( $logo ) ); ?>"
		alt="Nature & Reiki"
		width="<?php echo esc_attr( (string) $logo_width ); ?>"
		height="<?php echo esc_attr( (string) $logo_height ); ?>"
	>

</a>


<!-- SWITCH ENTRE LES DEUX UNIVERS + FB -->

<div class="header-actions">

	<div class="switch-univers">

		<!-- NATURE -->

		<a
			href="<?php echo esc_url( home_url( '/accueil-guide-nature/' ) ); ?>"
			class="switch-nature <?php echo $is_nature ? 'actif' : ''; ?>"<?php echo $is_nature ? ' aria-current="true"' : ''; ?>
		>
			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.svg' ) ); ?>"
				alt=""
				width="1377"
				height="1142"
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
			class="switch-reiki <?php echo $is_reiki ? 'actif' : ''; ?>"<?php echo $is_reiki ? ' aria-current="true"' : ''; ?>
		>
			Reiki
			<img
				src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.svg' ) ); ?>"
				alt=""
				width="1536"
				height="1024"
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
			width="1254"
			height="1254"
		>
	</a>

</div>

</header>
