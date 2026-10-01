<footer class="site-footer">
	<div class="footer-content">
		<p class="footer-copyright">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Nature &amp; Reiki — Joëlle Siwek
		</p>
	</div>
</footer>

<?php if ( nature_reiki_page_has_retour_haut() ) : ?>
	<!-- Flèche retour en haut -->
	<button
		type="button"
		class="retour-haut <?php echo nature_reiki_is_nature_context() ? 'retour-haut--nature' : 'retour-haut--reiki'; ?>"
		aria-label="Revenir en haut de la page"
	>
		<span aria-hidden="true"></span>
	</button>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
