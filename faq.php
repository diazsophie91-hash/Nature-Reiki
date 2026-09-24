<?php
/**
 * Template Name: F.A.Q
 *
 * @package Nature_Reiki
 */

get_header(); ?>

<main class="page-faq" id="main-content">

<?php
/**
 * Détermine l'ordre d'affichage des univers en FAQ.
 * L'univers d'origine est affiché en premier.
 */
$univers_ordre = ( 'nature' === nature_reiki_get_universe() )
	? array( 'nature', 'reiki' )
	: array( 'reiki', 'nature' );

$reiki_questions = array(
	'Comment se déroule une séance de Reiki ?',
	'Que peut-on ressentir pendant une séance ?',
	'Quels sont les bienfaits du Reiki ?',
	'Combien de séances faut-il prévoir ?',
	'Faut-il croire au Reiki pour ressentir ses bienfaits ?',
);

$guide_nature_questions = array(
	'Question 1',
	'Question 2',
	'Question 3',
	'Question 4',
	'Question 5',
);
?>

<section class="reiki-hero">
	<h1>F.A.Q</h1>
	<p>Les réponses à vos questions.</p>
	<div class="reiki-ligne-decoration">
		<span></span>
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.svg' ) ); ?>" alt="">
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.png' ) ); ?>" alt="">
		<span></span>
	</div>
</section>

<?php nature_reiki_display_menu(); ?>

<section class="soins-reiki-pratiques">
	<div class="soins-reiki-contenu">

<?php
foreach ( $univers_ordre as $univers_faq ) :
	$univers_id = 'faq-univers-' . sanitize_key( $univers_faq );
	$questions  = ( 'nature' === $univers_faq ) ? $guide_nature_questions : $reiki_questions;
	?>

	<div class="faq-univers">
		<button
			type="button"
			class="faq-univers-bouton"
			aria-expanded="true"
			aria-controls="<?php echo esc_attr( $univers_id ); ?>"
		>
			<span><?php echo ( 'nature' === $univers_faq ) ? 'Guide-Nature' : 'Reiki'; ?></span>
			<span class="faq-univers-fleche" aria-hidden="true"></span>
		</button>
		<div class="faq-univers-contenu" id="<?php echo esc_attr( $univers_id ); ?>">

	<?php
	for ( $i = 1; $i <= 5; $i++ ) :
		$question_id = $univers_id . '-question-' . $i;
		?>

			<div class="soins-reiki-accordeon">
				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
					aria-controls="<?php echo esc_attr( $question_id ); ?>"
				>
					<span><?php echo esc_html( $questions[ $i - 1 ] ); ?></span>
					<span class="soins-reiki-accordeon-fleche" aria-hidden="true"></span>
				</button>
				<div class="soins-reiki-accordeon-contenu" id="<?php echo esc_attr( $question_id ); ?>">
					<p>À venir</p>
				</div>
			</div>

	<?php endfor; ?>

		</div>
	</div>

<?php endforeach; ?>

	</div>
</section>

	<div class="separateur-dore" aria-hidden="true"></div>

</main>

<?php
get_footer();
