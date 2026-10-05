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
 * Détermine l’ordre d’affichage des univers en FAQ.
 * L’univers d'origine est affiché en premier.
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

$reiki_answers = array(
	'<p>Une séance Reiki se déroule comme suit :</p><p><strong>Accueil et petite discussion de prise de contact</strong></p><p>La personne reste habillée. Il n’y a aucune manipulation, juste l’imposition des mains à distance ou, si le receveur le permet, parfois directement sur le corps.<br>Il n’y a jamais de toucher sur les parties intimes.</p><p><strong>Installation</strong></p><p>Le receveur s’installe confortablement sur la table de soins, avec un plaid s’il le souhaite.</p><p>Durant la séance, une musique de relaxation sera diffusée.</p>',
	'<p>Durant les 4 séances de soins Reiki, certaines personnes s’endorment directement, d’autres ont très froid ou très chaud, tandis que d’autres ressentent une grande fatigue.</p><p>À la dernière séance, c’est un sentiment de bien-être et d’harmonie qui prédomine.</p><p>Lors des séances de suivi, les personnes ressentent généralement un sentiment de bien-être et de relaxation immédiat. D’autres récupèrent une énergie perdue.</p><p>Chaque séance est particulière et adaptée à la personne ; les ressentis et les bienfaits peuvent donc varier d’une séance à l’autre.</p>',
	'<p>Le Reiki est une pratique naturelle qui apporte un bien-être général à tous les niveaux de l’Être.</p><p>Le Reiki apporte plus de relaxation, aide à diminuer ou à faire disparaître le stress, apporte plus de clarté mentale et émotionnelle, et généralement déclenche un processus d’autoguérison.</p>',
	'<p>Il est vivement conseillé de commencer par 4 séances rapprochées.</p><p>Ces 4 séances représentent les 4 étapes théoriques du Reiki dans le fonctionnement énergétique.</p><p><strong><a class="lien-contextuel" href="/soins-reiki/">Voir les explications du pack de 4 séances.</a></strong></p><p>Après ces 4 séances, le receveur choisit de poursuivre ou non.</p><p>Tout dépend de son ressenti et de la raison pour laquelle il a fait appel au Reiki.</p><p>Il peut ensuite demander une séance lorsque le besoin se fait sentir, ou choisir un rythme régulier, par exemple tous les mois ou tous les trois mois.</p>',
);

$guide_nature_questions = array(
	'Question 1',
	'Question 2',
	'Question 3',
	'Question 4',
	'Question 5',
);

$nature_answers = array(
	'<p>À venir</p>',
	'<p>À venir</p>',
	'<p>À venir</p>',
	'<p>À venir</p>',
	'<p>À venir</p>',
);
?>

<section class="reiki-hero">
	<h1>F.A.Q</h1>
	<p>Les réponses à vos questions<span class="sous-titre-point">.</span></p>
	<div class="reiki-ligne-decoration">
		<span></span>
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.svg' ) ); ?>" alt="" width="1536" height="1024">
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.svg' ) ); ?>" alt="" width="1377" height="1142">
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

	<details class="faq-univers" open>
		<summary
			class="faq-univers-bouton"
			aria-controls="<?php echo esc_attr( $univers_id ); ?>"
		>
			<h2><?php echo ( 'nature' === $univers_faq ) ? 'Guide-Nature' : 'Reiki'; ?></h2>
			<span class="faq-univers-fleche" aria-hidden="true"></span>
		</summary>
		<div class="faq-univers-contenu" id="<?php echo esc_attr( $univers_id ); ?>">

	<?php
	$answers = ( 'nature' === $univers_faq ) ? $nature_answers : $reiki_answers;

	for ( $i = 1; $i <= 5; $i++ ) :
		$question_id = $univers_id . '-question-' . $i;
		?>

			<details class="soins-reiki-accordeon">
				<summary
					class="soins-reiki-accordeon-bouton"
					aria-controls="<?php echo esc_attr( $question_id ); ?>"
				>
					<h3><?php echo esc_html( $questions[ $i - 1 ] ); ?></h3>
					<span class="soins-reiki-accordeon-fleche" aria-hidden="true"></span>
				</summary>
				<div class="soins-reiki-accordeon-contenu" id="<?php echo esc_attr( $question_id ); ?>">
					<?php echo wp_kses_post( $answers[ $i - 1 ] ?? '<p>À venir</p>' ); ?>
				</div>
			</details>

	<?php endfor; ?>

		</div>
	</details>

<?php endforeach; ?>

	</div>
</section>

	<div class="separateur-dore" aria-hidden="true"></div>

</main>

<?php
get_footer();
