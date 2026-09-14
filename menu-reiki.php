<?php
/**
 * Navigation de l'univers Reiki.
 *
 * @package Nature_Reiki
 */

$menu_items = array(
	array(
		'label'    => 'Accueil',
		'template' => 'accueil-reiki.php',
		'slug'     => 'accueil-reiki',
		'url'      => home_url( '/accueil-reiki/' ),
	),
	array(
		'label'    => 'Qui suis-je ?',
		'template' => 'qui-suis-je.php',
		'slug'     => 'qui-suis-je',
		'url'      => home_url( '/qui-suis-je/?univers=reiki' ),
	),
	array(
		'label'    => 'Le Reiki',
		'template' => 'le-reiki.php',
		'slug'     => 'le-reiki',
		'url'      => home_url( '/le-reiki/' ),
	),
	array(
		'label'    => 'Soins Reiki',
		'template' => 'soins-reiki.php',
		'slug'     => 'soins-reiki',
		'url'      => home_url( '/soins-reiki/' ),
	),
	array(
		'label'    => 'Prendre rendez-vous',
		'template' => 'prendre-rendez-vous-reiki.php',
		'slug'     => 'prendre-rendez-vous-reiki',
		'url'      => home_url( '/prendre-rendez-vous-reiki/' ),
	),
	array(
		'label'    => 'F.A.Q',
		'template' => 'faq.php',
		'slug'     => 'faq',
		'url'      => home_url( '/faq/?univers=reiki' ),
	),
	array(
		'label'    => 'Me contacter',
		'template' => 'me-contacter.php',
		'slug'     => 'me-contacter',
		'url'      => home_url( '/me-contacter/?univers=reiki' ),
	),
);

?>

<nav class="reiki-menu" aria-label="Navigation Reiki">

	<?php foreach ( $menu_items as $item ) : ?>
		<?php $is_current = nature_reiki_is_current_page( $item['template'], $item['slug'] ); ?>
		<a href="<?php echo esc_url( $item['url'] ); ?>"
			class="<?php echo esc_attr( $is_current ? 'actif' : '' ); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>>
			<?php echo esc_html( $item['label'] ); ?>
		</a>
	<?php endforeach; ?>

</nav>
