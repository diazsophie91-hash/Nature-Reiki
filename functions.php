<?php
/**
 * Configuration et fonctions partagées du thème Nature & Reiki.
 *
 * @package Nature_Reiki
 */

/**
 * Active les fonctionnalités natives dont le thème a besoin.
 */
function nature_reiki_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'nature_reiki_setup' );

/**
 * Indique si la page courante est une page native Nature.
 *
 * @return bool
 */
function nature_reiki_is_native_nature() {
	$config = nature_reiki_get_universes_config();
	return nature_reiki_is_current_page( $config['nature']['templates'], $config['nature']['slugs'] );
}

/**
 * Indique si la page courante est une page native Reiki.
 *
 * @return bool
 */
function nature_reiki_is_native_reiki() {
	$config = nature_reiki_get_universes_config();
	return nature_reiki_is_current_page( $config['reiki']['templates'], $config['reiki']['slugs'] );
}

/**
 * Renvoie l'univers demandé, après validation de la valeur de l'URL ou détection native.
 *
 * @return string "nature" ou "reiki".
 */
function nature_reiki_get_universe() {
	if ( nature_reiki_is_native_nature() ) {
		return 'nature';
	}
	if ( nature_reiki_is_native_reiki() ) {
		return 'reiki';
	}

	$univers = isset( $_GET['univers'] )
		? sanitize_key( wp_unslash( $_GET['univers'] ) )
		: 'reiki';

	return in_array( $univers, array( 'nature', 'reiki' ), true )
		? $univers
		: 'reiki';
}

/**
 * Vérifie une page par son modèle lorsqu'il est attribué, ou par son slug.
 *
 * @param string|array $templates Modèle(s) de page attendus.
 * @param string|array $slugs     Slug(s) de page attendus.
 * @return bool
 */
function nature_reiki_is_current_page( $templates, $slugs ) {
	return is_page_template( $templates ) || is_page( $slugs );
}

/**
 * Configuration des deux univers et de leurs pages partagées.
 *
 * Format : 'univers' => array(
 *     'templates' => array( ... ),
 *     'slugs'     => array( ... ),
 * ).
 *
 * Les pages partagées (faq, qui-suis-je, me-contacter) sont assignées
 * à un univers selon le paramètre d'URL `?univers=`.
 */
function nature_reiki_get_universes_config() {
	return array(
		'reiki'  => array(
			'templates' => array(
				'accueil-reiki.php',
				'le-reiki.php',
				'soins-reiki.php',
				'prendre-rendez-vous-reiki.php',
			),
			'slugs'     => array(
				'accueil-reiki',
				'le-reiki',
				'soins-reiki',
				'prendre-rendez-vous-reiki',
			),
		),
		'nature' => array(
			'templates' => array(
				'accueil-guide-nature.php',
				'balades.php',
				'animations.php',
				'a-venir.php',
				'reserver.php',
			),
			'slugs'     => array(
				'accueil-guide-nature',
				'balades',
				'animations',
				'a-venir',
				'reserver',
			),
		),
	);
}

/**
 * Indique si la page courante appartient à un univers donné.
 *
 * @param string $univers Identifiant d'univers ('reiki' ou 'nature').
 * @return bool
 */
function nature_reiki_is_context( $univers ) {
	$config = nature_reiki_get_universes_config();
	if ( ! isset( $config[ $univers ] ) ) {
		return false;
	}
	$cfg = $config[ $univers ];

	$is_in_native_pages = nature_reiki_is_current_page(
		$cfg['templates'],
		$cfg['slugs']
	);

	if ( $is_in_native_pages ) {
		return true;
	}

	// Pages partagées : affectées selon le paramètre d'URL.
	$is_shared_page = nature_reiki_is_current_page(
		array(
			'faq.php',
			'qui-suis-je.php',
			'me-contacter.php',
		),
		array( 'faq', 'qui-suis-je', 'me-contacter' )
	);

	return $is_shared_page && nature_reiki_get_universe() === $univers;
}

/**
 * Indique si la page courante appartient à l'univers Reiki.
 *
 * @return bool
 */
function nature_reiki_is_reiki_context() {
	return nature_reiki_is_context( 'reiki' );
}

/**
 * Indique si la page courante appartient à l'univers Nature.
 *
 * @return bool
 */
function nature_reiki_is_nature_context() {
	return nature_reiki_is_context( 'nature' );
}

/**
 * Ajoute des classes au body pour le contexte et le type de page native.
 *
 * @param array $classes Classes CSS du body.
 * @return array
 */
function nature_reiki_body_classes( $classes ) {
	if ( nature_reiki_is_nature_context() ) {
		$classes[] = 'universe-nature';
	} elseif ( nature_reiki_is_reiki_context() ) {
		$classes[] = 'universe-reiki';
	}

	if ( nature_reiki_is_native_nature() ) {
		$classes[] = 'universe-native-nature';
	} elseif ( nature_reiki_is_native_reiki() ) {
		$classes[] = 'universe-native-reiki';
	}

	return $classes;
}
add_filter( 'body_class', 'nature_reiki_body_classes' );

/**
 * Indique si la page courante utilise un des accordéons du thème.
 * Utilisé pour ne charger le JS des accordéons que sur les pages concernées.
 *
 * @return bool
 */
function nature_reiki_page_has_accordion() {
	return nature_reiki_is_current_page(
		array( 'le-reiki.php', 'soins-reiki.php', 'faq.php', 'qui-suis-je.php', 'balades.php' ),
		array( 'faq', 'qui-suis-je', 'le-reiki', 'balades' )
	);
}
/**
 * Indique si la page courante possède le carrousel Nature.
 * Utilisé pour ne charger le JS du carrousel que sur la page balades.
 *
 * @return bool
 */
function nature_reiki_page_has_carrousel_nature() {
	return nature_reiki_is_current_page(
		array( 'balades.php' ),
		array( 'balades' )
	);
}

/**
 * Construit l'URL d'un fichier inclus dans le thème.
 *
 * @param string $path Chemin relatif au dossier du thème.
 * @return string
 */
function nature_reiki_asset_url( $path ) {
	return get_theme_file_uri( '/' . ltrim( $path, '/' ) );
}

/**
 * Charge la feuille de style principale et le JS des accordéons
 * avec la version du thème pour le cache.
 *
 * Le JS des accordéons n'est chargé que sur les pages qui en ont besoin.
 */
function nature_reiki_enqueue_assets() {
	$theme    = wp_get_theme();
	$min_css  = '/style.min.css';
	$css_file = file_exists( get_stylesheet_directory() . $min_css ) ? $min_css : '/style.css';
	$version  = filemtime( get_stylesheet_directory() . $css_file );

	wp_enqueue_style(
		'nature-reiki-style',
		get_stylesheet_directory_uri() . $css_file,
		array(),
		$version
	);

	if ( nature_reiki_page_has_accordion() ) {
		wp_enqueue_script(
			'nature-reiki-accordeon',
			nature_reiki_asset_url( 'assets/js/accordeon.js' ),
			array(),
			$version,
			true
		);
	}
if ( nature_reiki_page_has_carrousel_nature() ) {
		wp_enqueue_script(
			'nature-reiki-carrousel-nature',
			nature_reiki_asset_url( 'assets/js/carrousel-nature.js' ),
			array(),
			$version,
			true
		);
	}


	wp_enqueue_script(
		'nature-reiki-retour-haut',
		nature_reiki_asset_url( 'assets/js/retour-haut.js' ),
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nature_reiki_enqueue_assets' );

/**
 * Affiche le menu de navigation correspondant à l'univers courant.
 *
 * Utilise `menu-nature.php` si l'univers courant est "nature",
 * `menu-reiki.php` sinon.
 */
function nature_reiki_display_menu() {
	$template = 'nature' === nature_reiki_get_universe()
		? 'menu-nature'
		: 'menu-reiki';

	get_template_part( $template );
}
