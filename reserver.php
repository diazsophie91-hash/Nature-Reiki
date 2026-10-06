<?php
/*
Template Name: Réserver - Nature
*
* Page de réservation pour l’univers Nature.
* À compléter ultérieurement.
*/
?>
<?php get_header(); ?>

<main class="page-nature page-reserver" id="main-content">
	<section class="reiki-hero">
		<h1>Réserver</h1>
		<p>Réservez votre expérience Nature<span class="sous-titre-point">.</span></p>
		<div class="reiki-ligne-decoration">
			<span></span>
			<img src="<?php echo esc_url( nature_reiki_asset_url( 'images/feuille-chene.svg' ) ); ?>" alt="" width="1377" height="1142">
			<span></span>
		</div>
	</section>

	<?php nature_reiki_display_menu(); ?>

	<section class="reserver-section">
		<div class="reserver-contenu">
			<p>Page en construction, veuillez <a href="<?php echo esc_url( home_url( '/me-contacter/?univers=nature' ) ); ?>">me contacter par e-mail</a> afin de prendre rendez-vous, merci.</p>
		</div>
	</section>
<!-- =========================
    CTA FINAL — RÉSERVATION NATURE
========================== -->
<section class="soins-reiki-cta reserver-nature-cta-marker">

    <div class="separateur-dore" aria-hidden="true"></div>

    <div class="soins-reiki-cta-interieur">

        <h2>Une question avant votre réservation ?</h2>

        <div class="soins-reiki-cta-boutons">

            <a
                href="
                <?php
                echo esc_url(
                    home_url( '/faq/?univers=nature' )
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
                    home_url( '/me-contacter/?univers=nature' )
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
