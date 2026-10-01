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
	static $universe = null;

	if ( null === $universe ) {
		if ( nature_reiki_is_native_nature() ) {
			$universe = 'nature';
		} elseif ( nature_reiki_is_native_reiki() ) {
			$universe = 'reiki';
		} else {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- paramètre d'affichage limité à nature/reiki.
			$univers = isset( $_GET['univers'] ) && is_string( $_GET['univers'] )
			? sanitize_key( wp_unslash( $_GET['univers'] ) )
			: 'reiki';
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

			$universe = in_array( $univers, array( 'nature', 'reiki' ), true )
			? $univers
			: 'reiki';
		}
	}

	return $universe;
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
	static $config = null;

	if ( null === $config ) {
		$config = array(
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

	return $config;
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
 * Indique si la page courante utilise le bouton « retour en haut ».
 *
 * Le script associé n'est chargé que sur les pages où le contenu est
 * suffisamment long pour justifier ce contrôle.
 *
 * @return bool
 */
function nature_reiki_page_has_retour_haut() {
	return is_front_page() || nature_reiki_is_current_page(
		array(
			'accueil-reiki.php',
			'accueil-guide-nature.php',
			'le-reiki.php',
			'soins-reiki.php',
			'balades.php',
			'animations.php',
			'a-venir.php',
			'faq.php',
			'qui-suis-je.php',
			'me-contacter.php',
		),
		array(
			'accueil-reiki',
			'accueil-guide-nature',
			'le-reiki',
			'soins-reiki',
			'balades',
			'animations',
			'a-venir',
			'faq',
			'qui-suis-je',
			'me-contacter',
		)
	);
}

/**
 * Indique si la page courante utilise un des accordéons du thème.
 * Utilisé pour ne charger le JS des accordéons que sur les pages concernées.
 *
 * @return bool
 */
function nature_reiki_page_has_accordion() {
	return nature_reiki_is_current_page(
		array( 'le-reiki.php', 'soins-reiki.php', 'faq.php', 'qui-suis-je.php', 'balades.php' ),
		array( 'faq', 'qui-suis-je', 'le-reiki', 'soins-reiki', 'balades' )
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
 * Renvoie la date de modification d'un asset pour la gestion du cache.
 *
 * @param string $path Chemin relatif au dossier du thème.
 * @return string|null Timestamp de modification ou null si indisponible.
 */
function nature_reiki_asset_version( $path ) {
	$file = get_theme_file_path( '/' . ltrim( $path, '/' ) );

	if ( ! is_file( $file ) || ! is_readable( $file ) ) {
		return null;
	}

	$modified = filemtime( $file );

	return false !== $modified ? (string) $modified : null;
}

/**
 * Charge un fichier JavaScript, en utilisant sa version minifiée lorsqu'elle existe.
 *
 * @param string $handle Identifiant du script.
 * @param string $path   Chemin relatif vers le script non minifié.
 */
function nature_reiki_enqueue_script_asset( $handle, $path ) {
	$min_path       = substr( $path, 0, -3 ) . '.min.js';
	$min_version    = nature_reiki_asset_version( $min_path );
	$script_path    = null !== $min_version ? $min_path : $path;
	$script_version = null !== $min_version ? $min_version : nature_reiki_asset_version( $path );

	if ( null === $script_version ) {
		return;
	}

	wp_enqueue_script(
		$handle,
		nature_reiki_asset_url( $script_path ),
		array(),
		$script_version,
		true
	);
}

/**
 * Charge la feuille de style principale et les scripts du thème.
 *
 * Les scripts sont chargés uniquement sur les pages qui en ont besoin.
 */
function nature_reiki_enqueue_assets() {
	$min_css     = '/style.min.css';
	$css_file    = file_exists( get_stylesheet_directory() . $min_css ) ? $min_css : '/style.css';
	$css_version = nature_reiki_asset_version( $css_file );

	if ( null === $css_version ) {
		return;
	}

	wp_enqueue_style(
	    'nature-reiki-style',
	    get_stylesheet_directory_uri() . $css_file,
	    array(),
	    $css_version
	);

	if ( nature_reiki_page_has_accordion() ) {
		nature_reiki_enqueue_script_asset(
			'nature-reiki-accordeon',
			'assets/js/accordeon.js'
		);
	}

	if ( nature_reiki_page_has_carrousel_nature() ) {
		nature_reiki_enqueue_script_asset(
			'nature-reiki-carrousel-nature',
			'assets/js/carrousel-nature.js'
		);
	}

	if ( nature_reiki_page_has_retour_haut() ) {
		nature_reiki_enqueue_script_asset(
			'nature-reiki-retour-haut',
			'assets/js/retour-haut.js'
		);
	}
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

/**
 * Renvoie les éléments SEO définis pour la page courante.
 *
 * @return array
 */
function nature_reiki_get_seo_data() {
	$data = array(
		'title'       => '',
		'description' => '',
	);

	if ( is_front_page() ) {
		$data = array(
			'title'       => 'Nature & Reiki — Guide Nature et Reiki à Aywaille',
			'description' => 'Nature & Reiki propose deux univers à Aywaille : balades et découvertes de la nature, et accompagnement Reiki.',
		);
	} elseif ( nature_reiki_is_current_page( 'accueil-guide-nature.php', 'accueil-guide-nature' ) ) {
		$data = array(
			'title'       => 'Guide Nature à Aywaille',
			'description' => 'Découvrez les activités Guide Nature de Nature & Reiki à Aywaille : balades, animations et découverte de la nature.',
		);
	} elseif ( nature_reiki_is_current_page( 'accueil-reiki.php', 'accueil-reiki' ) ) {
		$data = array(
			'title'       => 'Reiki à Aywaille',
			'description' => 'Découvrez le Reiki proposé par Nature & Reiki à Aywaille : soins Reiki, informations sur la pratique et rendez-vous.',
		);
	} elseif ( nature_reiki_is_current_page( 'balades.php', 'balades' ) ) {
		$data = array(
			'title'       => 'Balades Nature à Aywaille',
			'description' => 'Découvrez les balades nature de Nature & Reiki à Aywaille : sorties guidées, balades privées et découvertes au fil des saisons.',
		);
	} elseif ( nature_reiki_is_current_page( 'animations.php', 'animations' ) ) {
		$data = array(
			'title'       => 'Animations Nature à Aywaille',
			'description' => 'Participez aux animations Nature de Nature & Reiki à Aywaille pour observer, comprendre et découvrir la nature.',
		);
	} elseif ( nature_reiki_is_current_page( 'a-venir.php', 'a-venir' ) ) {
		$data = array(
			'title'       => 'À venir – Guide Nature',
			'description' => 'Découvrez les prochaines activités et nouveautés de l’univers Guide Nature de Nature & Reiki.',
		);
	} elseif ( nature_reiki_is_current_page( 'le-reiki.php', 'le-reiki' ) ) {
		$data = array(
			'title'       => 'Le Reiki',
			'description' => 'Découvrez le Reiki, ses origines, son fonctionnement et les cinq Gokai à travers l’approche de Nature & Reiki.',
		);
	} elseif ( nature_reiki_is_current_page( 'soins-reiki.php', 'soins-reiki' ) ) {
		$data = array(
			'title'       => 'Soins Reiki à Aywaille',
			'description' => 'Découvrez les soins Reiki de Nature & Reiki : séance unique, pack de quatre séances et séance en forêt.',
		);
	} elseif ( nature_reiki_is_current_page( 'prendre-rendez-vous-reiki.php', 'prendre-rendez-vous-reiki' ) ) {
		$data = array(
			'title'       => 'Prendre rendez-vous pour un soin Reiki',
			'description' => 'Prenez rendez-vous pour un soin Reiki à Aywaille avec Nature & Reiki.',
		);
	} elseif ( nature_reiki_is_current_page( 'reserver.php', 'reserver' ) ) {
		$data = array(
			'title'       => 'Réserver une activité Nature',
			'description' => 'Réservez une activité Nature à Aywaille avec Nature & Reiki.',
		);
	} elseif ( nature_reiki_is_current_page( 'faq.php', 'faq' ) ) {
		if ( 'nature' === nature_reiki_get_universe() ) {
			$data = array(
				'title'       => 'FAQ Guide Nature',
				'description' => 'Retrouvez les réponses aux questions fréquentes sur les activités Guide Nature de Nature & Reiki.',
			);
		} else {
			$data = array(
				'title'       => 'FAQ Reiki',
				'description' => 'Retrouvez les réponses aux questions fréquentes sur les séances et la pratique du Reiki de Nature & Reiki.',
			);
		}
	} elseif ( nature_reiki_is_current_page( 'qui-suis-je.php', 'qui-suis-je' ) ) {
		$data = array(
			'title'       => 'Joëlle Siwek, Guide Nature et praticienne Reiki',
			'description' => 'Découvrez le parcours de Joëlle Siwek, Guide Nature et praticienne Reiki, et le lien entre ces deux univers.',
		);
	} elseif ( nature_reiki_is_current_page( 'me-contacter.php', 'me-contacter' ) ) {
		$data = array(
			'title'       => 'Me contacter',
			'description' => 'Retrouvez les coordonnées de Nature & Reiki à Aywaille pour vos questions sur le Reiki et les activités Nature.',
		);
	}

	return apply_filters( 'nature_reiki_seo_data', $data );
}

/**
 * Personnalise le titre du document pour les pages principales du site.
 *
 * @param array $parts Parties du titre du document.
 * @return array
 */
function nature_reiki_filter_document_title_parts( $parts ) {
	$seo = nature_reiki_get_seo_data();

	if ( empty( $seo['title'] ) ) {
		return $parts;
	}

	$parts['title'] = $seo['title'];

	if ( is_front_page() ) {
		$parts['site'] = '';
	}

	return $parts;
}
add_filter( 'document_title_parts', 'nature_reiki_filter_document_title_parts' );

/**
 * Affiche la meta description des pages SEO du thème.
 */
function nature_reiki_output_meta_description() {
	$seo = nature_reiki_get_seo_data();

	if ( empty( $seo['description'] ) ) {
		return;
	}

	echo '<meta name="description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
}
add_action( 'wp_head', 'nature_reiki_output_meta_description', 1 );

/**
 * Affiche les métadonnées Open Graph des pages SEO du thème.
 */
function nature_reiki_output_open_graph() {
	$seo = nature_reiki_get_seo_data();

	if ( empty( $seo['description'] ) ) {
		return;
	}

	$canonical_url = wp_get_canonical_url();

	if ( ! $canonical_url ) {
		return;
	}

	$site_name = get_bloginfo( 'name', 'display' );
	$title     = wp_get_document_title();
	$locale    = str_replace( '-', '_', get_locale() );

	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:locale" content="' . esc_attr( $locale ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $seo['description'] ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $canonical_url ) . '">' . "\n";
}
add_action( 'wp_head', 'nature_reiki_output_open_graph', 1 );

/**
 * Modifie le canonical des pages partagées selon l'univers courant.
 *
 * @param string $canonical_url URL canonique actuelle.
 * @return string
 */
function nature_reiki_filter_canonical_url( $canonical_url ) {
	if ( ! nature_reiki_is_current_page(
		array(
			'faq.php',
			'qui-suis-je.php',
			'me-contacter.php',
		),
		array(
			'faq',
			'qui-suis-je',
			'me-contacter',
		)
	) ) {
		return $canonical_url;
	}

	return add_query_arg(
		'univers',
		nature_reiki_get_universe(),
		remove_query_arg( 'univers', $canonical_url )
	);
}
add_filter( 'get_canonical_url', 'nature_reiki_filter_canonical_url', 10 );

/**
 * Affiche les données structurées LocalBusiness sur la page de contact.
 *
 * Les informations correspondent aux coordonnées actuellement affichées
 * sur la page de contact du site.
 */
function nature_reiki_output_local_business_schema() {
	if ( ! nature_reiki_is_current_page( 'me-contacter.php', 'me-contacter' ) ) {
		return;
	}

	$schema = array(
	    '@context'  => 'https://schema.org',
		'@type'     => 'LocalBusiness',
		'@id'       => home_url( '/#local-business' ),
		'name'      => get_bloginfo( 'name', 'display' ),
		'url'       => home_url( '/me-contacter/' ),
		'telephone' => '+32 497 81 21 83',
		'address'   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Rue du Doyare n°3',
			'postalCode'      => '4920',
			'addressLocality' => 'Aywaille',
			'addressCountry'  => 'BE',
		),
		'geo'       => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => 50.46512732466139,
			'longitude' => 5.689984781699726,
		),
	);

	$json = wp_json_encode(
		$schema,
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	if ( false === $json ) {
		return;
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD déjà encodé par wp_json_encode().
	echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}
add_action( 'wp_head', 'nature_reiki_output_local_business_schema', 2 );

/**
 * Affiche les données structurées du site sur la page d'accueil.
 */
function nature_reiki_output_website_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'WebSite',
		'@id'         => home_url( '/#website' ),
		'name'        => get_bloginfo( 'name', 'display' ),
		'url'         => home_url( '/' ),
		'description' => 'Nature & Reiki propose deux univers à Aywaille : balades et découvertes de la nature, et accompagnement Reiki.',
	);

	$json = wp_json_encode(
		$schema,
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	if ( false === $json ) {
		return;
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD déjà encodé par wp_json_encode().
	echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}
add_action( 'wp_head', 'nature_reiki_output_website_schema', 2 );

/**
 * Affiche les données structurées de la page de profil de Joëlle Siwek.
 */
function nature_reiki_output_profile_schema() {
	if ( ! nature_reiki_is_current_page( 'qui-suis-je.php', 'qui-suis-je' ) ) {
		return;
	}

	$canonical_url = wp_get_canonical_url();

	if ( ! $canonical_url ) {
		return;
	}

	$person_id = home_url( '/#joelle-siwek' );

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'ProfilePage',
		'@id'        => $canonical_url . '#profile',
		'url'        => $canonical_url,
		'name'       => 'Joëlle Siwek',
		'mainEntity' => array(
			'@type'       => 'Person',
			'@id'         => $person_id,
			'name'        => 'Joëlle Siwek',
			'jobTitle'    => 'Guide-Nature et carrière, praticienne Reiki',
			'description' => 'Joëlle Siwek est Guide-Nature et carrière et praticienne Reiki.',
			'url'         => home_url( '/qui-suis-je/' ),
		),
	);

	$json = wp_json_encode(
		$schema,
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	);

	if ( false === $json ) {
		return;
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD déjà encodé par wp_json_encode().
	echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}
add_action( 'wp_head', 'nature_reiki_output_profile_schema', 2 );
