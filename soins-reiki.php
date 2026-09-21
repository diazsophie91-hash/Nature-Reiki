<?php
/*
Template Name: Soins Reiki
*/
?>

<?php get_header(); ?>


<main class="page-soins-reiki" id="main-content">


	<!-- =========================
		HERO
	========================== -->

	<section class="reiki-hero">

		<h1>Soins Reiki</h1>

		<p>
			Prendre soin de soi, autrement.
		</p>

		<div class="reiki-ligne-decoration">

			<span></span>

			<img
				src="
				<?php
				echo esc_url(
					nature_reiki_asset_url( 'images/lotus.png' )
				);
				?>
				"
				alt=""
							aria-hidden="true"
							loading="lazy"
							decoding="async"
			>

			<span></span>

		</div>

	</section>


	<!-- =========================
		MENU REIKI
	========================== -->

	<?php nature_reiki_display_menu(); ?>


	<!-- =========================
		LES 3 SOINS
	========================== -->

	<section class="soins-reiki-types">

		<div class="soins-reiki-contenu">

			<div class="soins-reiki-types-grid">

<?php
$soins = array(
	array(
		'symbole_class' => 'soin-reiki-symbole soin-reiki-symbole-arbre',
		'image'         => 'images/arbre-vie.png',
		'titre'         => 'Pack 4 séances',
		'prix'          => '170 €',
		'description'   => 'Un accompagnement complet en quatre séances, conçu pour travailler progressivement sur l’équilibre énergétique et permettre au processus d’harmonisation de s’installer dans le temps. Particulièrement conseillé pour une première expérience du Reiki.',
		'test_html'     => 'Test énergétique avec pendule :                            <strong>compris dans le pack</strong>',
	),
	array(
		'symbole_class' => 'soin-reiki-symbole',
		'image'         => 'images/lotus.png',
		'titre'         => 'Séance unique',
		'prix'          => '55 €',
		'description'   => 'Une séance ponctuelle pour découvrir le Reiki, prendre un moment pour vous et bénéficier d’un soin adapté à vos besoins du moment.',
		'test_html'     => 'Test énergétique avec pendule : + 8 €',
	),
	array(
		'symbole_class' => 'soin-reiki-symbole',
		'image'         => 'images/feuille-chene.png',
		'titre'         => 'Séance en forêt',
		'prix'          => '70 €',
		'description'   => 'Une séance de Reiki au cœur de la nature, associant le soin énergétique à un environnement propice au calme, à la détente et à la reconnexion.',
		'test_html'     => 'Cette séance dépend des conditions météorologiques. Il n\'y a pas de test énergétique pour ce type de séance.',
	),
);

foreach ( $soins as $soin ) :
	?>

				<article class="soin-reiki-card">

					<div class="<?php echo esc_attr( $soin['symbole_class'] ); ?>">

						<img
							src="
							<?php
							echo esc_url(
								nature_reiki_asset_url( $soin['image'] )
							);
							?>
							"
							alt=""
							aria-hidden="true"
							loading="lazy"
							decoding="async"
							>

					</div>

					<h2><?php echo esc_html( $soin['titre'] ); ?></h2>

					<div class="soin-reiki-prix">
						<?php echo esc_html( $soin['prix'] ); ?>
					</div>

					<button
						type="button"
						class="soin-reiki-en-savoir-plus"
						aria-expanded="false"
					>
						En savoir plus
						<span class="soin-reiki-fleche"></span>
					</button>

					<div class="soin-reiki-details">

						<p>
							<?php echo esc_html( $soin['description'] ); ?>
						</p>

						<p class="soin-reiki-test">
							<?php echo wp_kses( $soin['test_html'], array( 'strong' => array() ) ); ?>
						</p>

					</div>

				</article>

<?php endforeach; ?>

			</div>

			<!-- =========================
				RENDEZ-VOUS
				BOUTON COMMUN AUX 3 SOINS
			========================== -->

			<div class="soins-reiki-rendez-vous-global">

				<a
					href="
					<?php
					echo esc_url(
						home_url( '/prendre-rendez-vous-reiki/' )
					);
					?>
					"
					class="soin-reiki-rendez-vous"
				>
					Réserver votre soin Reiki
				</a>

			</div>


		</div>

	</section>


	<!-- =========================
		TEST ÉNERGÉTIQUE
	========================== -->

	<section class="le-reiki-section soins-reiki-test-energetique">

		<div class="le-reiki-contenu ouvert">

			<button
				class="le-reiki-toggle"
				type="button"
				aria-expanded="true"
			>
				<span>
					Test énergétique avec pendule

					<img
						src="
						<?php
						echo esc_url(
							nature_reiki_asset_url( 'images/pendule.png' )
						);
						?>
						"
						alt=""
						class="icone-pendule"
					>
				</span>

				<span
					class="le-reiki-fleche"
							aria-hidden="true"
				></span>

			</button>


			<div class="le-reiki-accordeon-contenu ouvert">

				<p>
					Tout être vivant est traversé par une énergie, dont l’équilibre peut varier au fil du temps et selon les différents aspects de notre être.
				</p>

				<p>
					Dans le cadre de ma pratique, le pendule me permet d’explorer cet équilibre énergétique et d’obtenir des indications sur votre état du moment.
				</p>

				<p>
					Je testerai votre <strong>taux vibratoire</strong> selon trois dimensions : physique, énergétique et spirituelle.
				</p>

				<p>
					J’effectuerai également un test des <strong>7 chakras principaux</strong>, afin d’identifier d’éventuels déséquilibres et de travailler à leur harmonisation, dans le but de favoriser une circulation plus fluide de l’énergie.
				</p>

				<p>
					L’objectif est de vous offrir un <strong>temps d’écoute et d’exploration de votre équilibre énergétique</strong>, et de vous aider à prendre conscience de ce qui peut être rééquilibré.
				</p>

				<p>
					Le test énergétique est compris dans le Pack 4 séances.
				</p>

				<p>
					Pour une séance unique, il est proposé avec un supplément de 8 €.
				</p>

				<p>
					Pas de test énergétique pour la séance en forêt, qui se concentre sur l’expérience de l’immersion dans la nature et le soin Reiki.
				</p>

			</div>

		</div>

	</section>


	<!-- =========================
		LES SOINS EN DÉTAIL
	========================== -->

	<section class="le-reiki-section soins-reiki-explications">

		<div class="le-reiki-contenu ouvert">

			<button
				class="le-reiki-toggle"
				type="button"
				aria-expanded="true"
			>
				<span>Les soins en détail</span>

				<span
					class="le-reiki-fleche"
							aria-hidden="true"
				></span>

			</button>


			<div class="le-reiki-accordeon-contenu ouvert">

				<!-- =========================
					PACK 4 SÉANCES
				========================== -->

				<article class="soin-reiki-explication">

					<h3>Pack 4 séances</h3>

					<p>
						Ce traitement complet est vivement conseillé, surtout si vous n’avez jamais reçu de soins Reiki.
					</p>

					<p>
						Idéalement, les quatre séances sont réalisées à quelques jours d’intervalle afin de permettre au processus de s’installer progressivement.
					</p>

					<p>
						<strong>Les quatre étapes du traitement :</strong>
					</p>

					<p>
						<strong>1ère séance — Nettoyage et rééquilibrage</strong>
					</p>

					<p>
						Cette première séance vise à accompagner l’évacuation des tensions et à travailler sur les déséquilibres énergétiques.
					</p>

					<p>
						<strong>2ème séance — Mise en mouvement de l’énergie Reiki</strong>
					</p>

					<p>
						Le travail énergétique se poursuit afin d’accompagner la circulation de l’énergie.
					</p>

					<p>
						<strong>3ème séance — Accompagnement du processus d’harmonisation</strong>
					</p>

					<p>
						Cette étape permet de poursuivre le travail engagé lors des deux premières séances.
					</p>

					<p>
						<strong>4ème séance — Harmonisation du système énergétique</strong>
					</p>

					<p>
						Cette dernière séance vient compléter le processus et accompagner l’harmonisation globale.
					</p>

					<p>
						<strong>Test énergétique</strong>
					</p>

					<p>
						Un test énergétique comprenant l’évaluation du taux vibratoire et l’observation des 7 chakras principaux est réalisé lors de la première et de la dernière séance. Il permet d’observer l’évolution de l’équilibre énergétique au cours du traitement.
					</p>

				</article>

				<!-- =========================
					SÉANCE UNIQUE
				========================== -->

				<article class="soin-reiki-explication">

					<h3>Séance unique</h3>

					<p>
						La séance unique est un moment consacré à soi, qui permet de découvrir le Reiki ou de bénéficier ponctuellement de ses bienfaits.
					</p>

					<p>
						Elle offre un temps pour ralentir, se recentrer et accueillir ce qui est présent au moment de la séance.
					</p>

					<p>
						Le soin Reiki s’inscrit dans une approche d’accompagnement énergétique et peut être choisi lorsque l’on ressent le besoin de prendre soin de soi, de retrouver davantage d’équilibre ou simplement de s’accorder une pause.
					</p>

					<p>
						Chaque séance est différente et s’adapte à la personne et à son état du moment.
					</p>

				</article>



				<!-- =========================
					SÉANCE EN FORÊT
				========================== -->

				<article class="soin-reiki-explication">

					<h3>Séance en forêt</h3>

					<p>
						Lors de mes balades en forêt, il m’est arrivé de m’arrêter un moment, ressentant le besoin de m’offrir un auto-soin de Reiki. Ces moments me redonnaient de l’énergie et m’aidaient à retrouver des forces parfois diminuées par les aléas de la vie.
					</p>

					<p>
						Alors, pourquoi ne pas en faire profiter d’autres personnes ?
					</p>

					<p>
						Depuis plusieurs décennies, les bienfaits de l’immersion en forêt sont étudiés par la science. Le contact avec cet environnement naturel peut notamment avoir des effets bénéfiques sur notre organisme et notre bien-être.
					</p>

					<p>
						Les arbres et les plantes libèrent des <strong>phytocides</strong>, des composés organiques volatils auxquels notre organisme est exposé lors d’une immersion en forêt. Certaines recherches associent cette exposition à une stimulation de certaines fonctions de notre système immunitaire.
					</p>

					<p>
						L’immersion en forêt est également associée à une diminution du <strong>stress et du taux de cortisol</strong>, l’une des principales hormones impliquées dans la réponse au stress.
					</p>

					<p>
						Mais au-delà de ces effets physiologiques, la forêt offre surtout un environnement propice au <strong>calme, à la détente et au bien-être</strong>. Elle nous invite à ralentir, à respirer, à observer et à nous reconnecter à nous-mêmes.
					</p>

					<p>
						C’est dans cet environnement que je souhaite proposer des <strong>séances de Reiki en forêt</strong>, en associant les bienfaits d’un moment passé au cœur de la nature à ceux d’un soin Reiki.
					</p>

					<p>
						Un moment pour ralentir, prendre soin de soi, se reconnecter à ses sensations et simplement <strong>s’accorder une pause</strong>.
					</p>

					<p>
						La séance en forêt dépend des conditions météorologiques. En cas de météo défavorable, la séance pourra être reportée.
					</p>

				</article>


			</div>

		</div>

	</section>


	<!-- =========================
		INFORMATIONS PRATIQUES
	========================== -->

	<section class="soins-reiki-pratiques">

		<div class="soins-reiki-contenu">

			<h2>Informations pratiques</h2>


			<!-- =========================
				LIEU
			========================== -->

			<div class="soins-reiki-accordeon">

				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
				>
					<span>Lieu</span>

					<span class="soins-reiki-accordeon-fleche"></span>
				</button>

				<div class="soins-reiki-accordeon-contenu">

					<p>
						Les séances se déroulent à l’adresse suivante : Rue du Doyare n°3, 4920 Aywaille.
					</p>

					<p>
						Pour la séance en forêt, le rendez-vous se fait à cette même adresse, sauf indication contraire lors de la prise de rendez-vous.
					</p>

				</div>

			</div>


			<!-- =========================
				DURÉE
			========================== -->

			<div class="soins-reiki-accordeon">

				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
				>
					<span>Durée</span>
					<span class="soins-reiki-accordeon-fleche"></span>
				</button>

				<div class="soins-reiki-accordeon-contenu">

					<p>
						Les séances de Reiki durent environ 1 heure. 
					</p>

					<p>
						Pour une première rencontre, prévoir environ 15 minutes supplémentaires.
					</p>

					<p>
						Si un test énergétique est prévu, compter également environ 15 minutes supplémentaires.
					</p>

				</div>

			</div>


			<!-- =========================
				PAIEMENT
			========================== -->

			<div class="soins-reiki-accordeon">

				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
				>
					<span>Paiement</span>
					<span class="soins-reiki-accordeon-fleche"></span>
				</button>

				<div class="soins-reiki-accordeon-contenu">

					<p>
						Le paiement s'effectue en espèces.
					</p>

				</div>

			</div>


			<!-- =========================
				QUE FAUT-IL PRÉVOIR ?
			========================== -->

			<div class="soins-reiki-accordeon">

				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
				>
					<span>Que faut-il prévoir ?</span>
					<span class="soins-reiki-accordeon-fleche"></span>
				</button>

				<div class="soins-reiki-accordeon-contenu">

					<p>
						Pour les séances de Reiki, le receveur reste habillé pendant toute la durée du soin. 
					</p>
					
					<p>
						Pour une séance en forêt, prévoir une tenue et des chaussures adaptées aux conditions météorologiques ainsi qu’un ou plusieurs plaids.
					</p>

					<p>
						Pensez à apporter de l'eau et à vous hydrater avant et après la séance.
					</p>

				</div>

			</div>


			<!-- =========================
				SÉANCE EN FORÊT
			========================== -->

			<div class="soins-reiki-accordeon">

				<button
					type="button"
					class="soins-reiki-accordeon-bouton"
					aria-expanded="false"
				>
					<span>Séance en forêt</span>
					<span class="soins-reiki-accordeon-fleche"></span>
				</button>

				<div class="soins-reiki-accordeon-contenu">

					<p>
						La séance en forêt dépend des conditions météorologiques. En cas de météo défavorable, elle pourra être reportée.
					</p>

				</div>

			</div>

		</div>

	</section>


	<!-- =========================
		CTA FINAL
	========================== -->

	<section class="soins-reiki-cta">

		<div class="separateur-dore" aria-hidden="true"></div>

		<div class="soins-reiki-cta-interieur">

			<h2>Une question avant votre rendez-vous ?</h2>

			<div class="soins-reiki-cta-boutons">

				<a
					href="
					<?php
					echo esc_url(
						home_url( '/faq/' )
					);
					?>
					"
					class="soins-reiki-cta-bouton"
				>
					F.A.Q
				</a>

				<a
					href="
					<?php
					echo esc_url(
						home_url( '/me-contacter/?univers=reiki' )
					);
					?>
					"
					class="soins-reiki-cta-bouton"
				>
					Me contacter
				</a>

			</div>

		</div>

	</section>


</main>


<?php get_footer(); ?>
