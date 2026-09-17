<?php
/**
 * Navigation de l'univers Nature.
 *
 * Ce fichier est chargé depuis les pages partagées lorsqu'elles sont ouvertes
 * avec le paramètre ?univers=nature.
 *
 * @package Nature_Reiki
 */

$menu_items = array(
	array(
		'label'    => 'Accueil',
		'template' => 'accueil-guide-nature.php',
		'slug'     => 'accueil-guide-nature',
		'url'      => home_url( '/accueil-guide-nature/' ),
	),
	array(
		'label'    => 'Qui suis-je ?',
		'template' => 'qui-suis-je.php',
		'slug'     => 'qui-suis-je',
		'url'      => home_url( '/qui-suis-je/?univers=nature' ),
	),
	array(
		'label'    => 'Balades',
		'template' => 'balades.php',
		'slug'     => 'balades',
		'url'      => home_url( '/balades/' ),
	),
	array(
		'label'    => 'Animations',
		'template' => 'animations.php',
		'slug'     => 'animations',
		'url'      => home_url( '/animations/' ),
	),
	array(
		'label'    => 'À venir',
		'template' => 'a-venir.php',
		'slug'     => 'a-venir',
		'url'      => home_url( '/a-venir/' ),
	),
	array(
		'label'    => 'Réserver',
		'template' => 'reserver.php',
		'slug'     => 'reserver',
		'url'      => home_url( '/reserver/' ),
	),
	array(
		'label'    => 'F.A.Q',
		'template' => 'faq.php',
		'slug'     => 'faq',
		'url'      => home_url( '/faq/?univers=nature' ),
	),
	array(
		'label'    => 'Me contacter',
		'template' => 'me-contacter.php',
		'slug'     => 'me-contacter',
		'url'      => home_url( '/me-contacter/?univers=nature' ),
	),
);

?>

<nav class="nature-menu" aria-label="Navigation Nature">

	<?php foreach ( $menu_items as $item ) : ?>
		<?php $is_current = nature_reiki_is_current_page( $item['template'], $item['slug'] ); ?>
		<a href="<?php echo esc_url( $item['url'] ); ?>"
			class="<?php echo esc_attr( $is_current ? 'actif' : '' ); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>>
			<?php echo esc_html( $item['label'] ); ?>
		</a>
	<?php endforeach; ?>

</nav>