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

$reiki_answers = array(
	'<p>Une séance Reiki se déroule comme suit :</p><p><strong>Accueil et petite discussion de prise de contact</strong></p><p>La personne reste habillée. Il n’y a aucune manipulation, juste l’imposition des mains à distance ou, si le receveur le permet, parfois directement sur le corps.<br>Il n’y a jamais de toucher sur les parties intimes.</p><p><strong>Installation</strong></p><p>Le receveur s’installe confortablement sur la table de soins, avec un plaid s’il le souhaite.</p><p>Durant la séance, une musique de relaxation sera diffusée.</p>',
	'<p>Durant les 4 séances de soins Reiki, certaines personnes s’endorment directement, d’autres ont très froid ou très chaud ou ressentent également une grande fatigue.</p><p>Mais à la dernière séance, c’est un sentiment de bien-être et d’harmonie qui prédomine.</p><p>Lors des séances de suivi, les personnes ressentent généralement un sentiment de bien-être et de relaxation immédiat. D’autres récupèrent une énergie perdue.</p><p>Chaque séance de soins est particulière et adaptée à la personne. C’est pour cette raison que les bienfaits sont différents.</p>',
	'<p>Le Reiki est une pratique naturelle qui apporte un bien-être général à tous les niveaux de l’Être.</p><p>Le Reiki apporte plus de relaxation, aide à diminuer, ou à faire disparaître le stress, apporte plus de clarté mentale et émotionnelle, et généralement déclenche un processus d’autoguérison.</p>',
	'<p>Il est vivement conseillé de faire dans un premier temps 4 séances rapprochées dans le temps.</p><p>Ces 4 séances représentent les 4 étapes théoriques du Reiki dans le fonctionnement énergétique.</p><p><strong>Voir explication pack de 4 séances.</strong></p><p>Après ces 4 séances, le receveur choisit de continuer ou pas.</p><p>Tout dépend de son ressenti et de la raison pour laquelle il a fait appel au Reiki.</p><p>Il peut demander une séance lorsque le besoin se fait sentir ou alors décider de faire une séance de façon régulière, comme par exemple tous les mois ou tous les 3 mois, etc.</p>',
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
	<p>Les réponses à vos questions<span class="sous-titre-point">.</span></p>
	<div class="reiki-ligne-decoration">
		<span></span>
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/lotus.svg' ) ); ?>" alt="">
		<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.svg' ) ); ?>" alt="">
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
					<?php echo $reiki_answers[ $i - 1 ] ?? '<p>À venir</p>'; ?>
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
