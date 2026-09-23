<?php
/*
Template Name: Qui suis-je ?
*/
?>

<?php get_header(); ?>


<main class="page-qui-suis-je" id="main-content">


	<?php
	/*
	 * Détermination de l'univers d'origine
	 */

	$est_nature = 'nature' === nature_reiki_get_universe();

	/*
	 * Ordre des deux parcours selon l'univers d'origine
	 */

	$ordre_parcours = $est_nature
		? array( 'nature', 'reiki' )
		: array( 'reiki', 'nature' );
	?>


	<!-- =========================
		HERO
	========================== -->

	<section class="reiki-hero">

		<h1>Joëlle Siwek</h1>

		<p>
			<span class="sous-titre-reiki">Praticienne Reiki</span>
			<span class="sous-titre-dore">&amp;</span>
			<span class="sous-titre-nature">Guide-nature et carrière</span><span class="sous-titre-point">.</span>
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


			<img
				src="
				<?php
				echo esc_url(
					nature_reiki_asset_url( 'images/feuille-chene.png' )
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
		MENU
	========================== -->

	<?php nature_reiki_display_menu(); ?>


	<!-- =========================
		CONTENU — INTRODUCTION
	========================== -->

	<section class="qui-suis-je-introduction">

		<div class="qui-suis-je-contenu">

			<h2>Introduction</h2>

			<p>
				Née sous le signe du Taureau, je suis une vraie épicurienne, attirée et émerveillée par la Nature depuis toujours.
			</p>

			<p>
				Depuis mon enfance, la nature a toujours occupé une place particulière dans ma vie. Les plantes, les arbres, les animaux, les oiseaux… tout ce qui compose le vivant a toujours éveillé ma curiosité. C’est un espace où je pouvais être au calme, m’émerveiller et simplement me sentir exister. La forêt soignait mes bleus à l’âme, calmait mes émotions exacerbées.
			</p>

			<p>
				Aujourd’hui encore, cette relation à la nature fait pleinement partie de mon quotidien. Elle se retrouve dans ma façon de vivre, d’observer, de cultiver et de prendre soin de ce qui m’entoure.
			</p>

			<p>
				En parallèle, mon côté spirituel avait également besoin de développement et de compréhension. Le Reiki est ainsi venu naturellement trouver sa place dans mon parcours, comme un autre chemin d’exploration, tourné davantage vers l’énergie, l’intériorité, l’harmonie et l’accompagnement de l’humain.
			</p>

			<p>
				Au fil de mon parcours, ces deux univers se sont construits et ont pris leur place dans ma vie. <strong>Deux chemins différents, mais qui se rejoignent dans une même envie : transmettre, accompagner et contribuer, à ma manière, au bien-être de chacun et à une relation plus consciente au vivant.</strong>
			</p>

			<p>
				C’est cette complémentarité entre <strong>Reiki et Guide-Nature</strong> que je souhaite aujourd’hui partager à travers <em>Nature &amp; Reiki</em>.
			</p>

		</div>

	</section>


	<?php foreach ( $ordre_parcours as $parcours ) : ?>


		<?php if ( 'nature' === $parcours ) : ?>

			<!-- =========================
				MON PARCOURS GUIDE-NATURE
			========================== -->

			<section class="qui-suis-je-parcours qui-suis-je-nature">

				<button
					class="le-reiki-toggle"
					type="button"
					aria-expanded="false"
				>

					<span>Mon parcours Guide-Nature</span>

					<span
						class="le-reiki-fleche"
				aria-hidden="true"
					></span>

				</button>


				<div class="le-reiki-accordeon-contenu qui-suis-je-parcours-contenu">

					<div class="qui-suis-je-photo">

						<img
							src="
							<?php
							echo esc_url(
								nature_reiki_asset_url( 'images/chene.png' )
							);
							?>
							"
							alt="Chêne"
				loading="lazy"
				decoding="async"
				>

					</div>


					<div class="qui-suis-je-contenu">

						<p>
				<strong>Suite à un grave accident, ma vie a pris un virage à 180°.</strong>
			</p>

						<p>
				Cet événement m’a amenée à repenser profondément ce que je voulais faire et surtout ce qui avait du sens pour moi. J’ai ressenti le besoin de revenir à ce qui est important et à ce qui compte vraiment pour l’humain : <strong>la connexion à la nature</strong>.
			</p>

						<p>
				J’ai alors choisi de me tourner vers ce qui m’attirait depuis toujours et de construire une nouvelle voie autour de cette passion. Pendant deux années, j’ai suivi un cursus d’<strong>Interprète Nature et Environnement et Guide Nature</strong>. Après l’obtention du brevet, j’ai enchaîné avec une formation de <strong>Guide Carrière</strong>, ainsi qu’une formation en <strong>herboristerie</strong>.
			</p>

						<p>
				La nature m’intéresse dans toute sa richesse : les plantes sauvages, les arbres, les animaux, les traces et indices, la géologie, l’écologie… mais aussi l’histoire, que j’aime particulièrement.
			</p>

						<p>
				J’aime observer, comprendre et approfondir mes connaissances, mais aussi partager ce que je découvre.
			</p>

						<p>
				Pour moi, être Guide-Nature, c’est avant tout échanger. En effet, ce n’est pas seulement de la transmission : nous avons en chacun de nous des connaissances que bien souvent nous ignorons et qui se révèlent souvent lors des guidances. C’est également permettre à chacun d’apprendre, de s’émerveiller et de changer son regard sur la nature.
			</p>

						<p>
				Je considère qu’il est d’utilité publique de mieux connaître la nature, car <strong>mieux la comprendre permet aussi de mieux la respecter</strong>. Mon souhait est de partager mes connaissances et de donner à chacun l’envie d’observer, de comprendre et de porter un regard différent sur le monde qui nous entoure.
			</p>

					</div>

				</div>

			</section>


		<?php elseif ( 'reiki' === $parcours ) : ?>

			<!-- =========================
				MON PARCOURS REIKI
			========================== -->

			<section class="qui-suis-je-parcours qui-suis-je-reiki">

				<button
					class="le-reiki-toggle"
					type="button"
					aria-expanded="false"
				>

					<span>Mon parcours Reiki</span>

					<span
						class="le-reiki-fleche"
				aria-hidden="true"
					></span>

				</button>


				<div class="le-reiki-accordeon-contenu qui-suis-je-parcours-contenu">

					<div class="qui-suis-je-contenu">

						<p>
				En parallèle de mon chemin vers la nature, une autre dimension de ma vie avait besoin d’être explorée.
			</p>

						<p>
				Mon côté spirituel avait besoin de développement et de compréhension. Je me suis notamment interrogée sur la manière dont je pouvais aider ma famille et sur la possibilité de briser certains schémas familiaux.
			</p>

						<p>
				J’ai eu la chance de suivre durant une année une formation de Racinologie Holistique auprès d’Alain Fournier.
			</p>

						<p>
				Lors de ces cours, j’ai découvert le Reiki par l’intermédiaire de ma future Maître Reiki. Il n’y a jamais de hasard, juste de belles rencontres.
			</p>

						<p>
				Durant trois années, je me suis formée au <strong>Reiki Usui auprès de la Maître Reiki Dominique Pfeiffer</strong>.
			</p>

						<p>
				Cette pratique m’a permis d’approfondir une dimension à la fois spirituelle et énergétique, qui trouve naturellement sa place dans mon parcours.
			</p>

						<p>
				Aujourd’hui, je propose à mon tour cet accompagnement avec une intention simple : <strong>accompagner et soulager les personnes qui viennent à moi</strong>, en mettant à profit ce que j’ai appris et ce que je sais faire.
			</p>

					</div>


					<div class="qui-suis-je-photo">

						<img
							src="
							<?php
							echo esc_url(
								nature_reiki_asset_url( 'images/arbre-vie.png' )
							);
							?>
							"
							alt="Arbre de vie"
				loading="lazy"
				decoding="async"
				>

					</div>

				</div>
				
					<div class="ligne-reiki-decoration">
		<img
			src="
			<?php
			echo esc_url(
				nature_reiki_asset_url( 'images/lignee-reiki.png' )
			);
			?>
			"
			alt=""
		>
	</div>

</div>

			</section>


		<?php endif; ?>


	<?php endforeach; ?>


	<!-- =========================
		LE LIEN ENTRE LES DEUX
	========================== -->

	<section class="qui-suis-je-lien">

		<div class="qui-suis-je-contenu">

			<h2>Le lien entre Reiki et Guide-Nature</h2>

			<p>
				À première vue, le Reiki et la nature peuvent sembler être deux univers différents.
			</p>

			<p>
				Pourtant, pour moi, ils sont profondément liés, ils vibrent dans la même énergie vitale.
			</p>

			<p>
				Tous deux s’inscrivent dans une même recherche : <strong>revenir à l’essentiel, prendre soin de soi, cultiver le lien avec le vivant et retrouver un équilibre entre soi et ce qui nous entoure.</strong>
			</p>

			<p>
				La nature m’apprend à observer, à ralentir, à m’émerveiller et à respecter ce qui m’entoure. Le Reiki m’ouvre davantage à l’écoute intérieure et à une dimension spirituelle et énergétique.
			</p>

			<p>
				Ces deux chemins se rejoignent donc naturellement dans ma manière d’accompagner les autres.
			</p>

			<p>
				Que ce soit au cœur d’une forêt, à la découverte d’une plante, en observant un oiseau ou lors d’un soin Reiki, mon souhait reste le même : <strong>offrir un espace où l’on peut prendre le temps, découvrir, ressentir et se reconnecter.</strong>
			</p>

			<p>
				C’est cette vision que je souhaite partager à travers <strong>Nature &amp; Reiki</strong>.
			</p>

		</div>

	</section>


	<!-- =========================
		CITATION FINALE
	========================== -->

	<section class="qui-suis-je-citation">

		<div class="separateur-dore" aria-hidden="true"></div>

		<div class="qui-suis-je-citation-interieur">

			<span class="qui-suis-je-citation-lumineuse">
				<span class="qui-suis-je-citation-guillemets">« </span>
				<span class="qui-suis-je-citation-texte">La vie, ce n’est pas d’attendre que les orages passent, c’est d’apprendre comment danser sous la pluie.</span>
				<span class="qui-suis-je-citation-guillemets"> »</span>
				<span class="qui-suis-je-citation-auteur">- Sénèque</span>
			</span>

		</div>

	</section>


</main>


<?php get_footer(); ?>
