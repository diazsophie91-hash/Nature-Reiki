/**
 * Menu hamburger mobile du thème Nature & Reiki.
 *
 * Le bouton ouvre et ferme le panneau de l'en-tête (switch Nature/Reiki,
 * Facebook et navigation). Le panneau se ferme avec Échap, un clic à
 * l'extérieur, la sortie du focus clavier ou un retour à la largeur desktop.
 *
 * @package Nature_Reiki
 */

( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var header = document.querySelector( '.accueil-header' );
		var bouton = document.querySelector( '.menu-toggle' );
		var panneau = document.getElementById( 'header-menu' );

		if ( ! header || ! bouton || ! panneau ) {
			return;
		}

		var largeurDesktop = window.matchMedia( '(min-width: 801px)' );

		var definirEtat = function ( ouvert ) {
			panneau.classList.toggle( 'is-open', ouvert );
			bouton.setAttribute( 'aria-expanded', ouvert ? 'true' : 'false' );
			bouton.setAttribute( 'aria-label', ouvert ? 'Fermer le menu' : 'Ouvrir le menu' );
		};

		var estOuvert = function () {
			return 'true' === bouton.getAttribute( 'aria-expanded' );
		};

		bouton.addEventListener( 'click', function () {
			definirEtat( ! estOuvert() );
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && estOuvert() ) {
				definirEtat( false );
				bouton.focus();
			}
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( estOuvert() && ! header.contains( event.target ) ) {
				definirEtat( false );
			}
		} );

		header.addEventListener( 'focusout', function ( event ) {
			if ( estOuvert() && event.relatedTarget && ! header.contains( event.relatedTarget ) ) {
				definirEtat( false );
			}
		} );

		largeurDesktop.addEventListener( 'change', function ( event ) {
			if ( event.matches ) {
				definirEtat( false );
			}
		} );
	} );
} )();
