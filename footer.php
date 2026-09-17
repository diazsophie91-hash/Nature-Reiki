<footer class="site-footer">
	<div class="footer-content">
		<p class="footer-copyright">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Nature &amp; Reiki — Joëlle Siwek
		</p>
	</div>
</footer>

<!-- Flèche retour en haut -->
<button
	type="button"
	class="retour-haut <?php echo nature_reiki_is_nature_context() ? 'retour-haut--nature' : 'retour-haut--reiki'; ?>"
	aria-label="Revenir en haut de la page"
	aria-hidden="true"
>
	<span aria-hidden="true"></span>
</button>

<?php wp_footer(); ?>
</body>
</html>
