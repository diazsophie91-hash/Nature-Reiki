/**
 * Carrousel de l'univers Nature.
 *
 * Carrousel maison, sans librairie externe. Chaque carrousel est repéré
 * par l'attribut `data-nature-carrousel` et fonctionne de façon autonome.
 *
 * Fonctionnalités :
 *  - flèches précédent / suivant (bouclage sur la première et la dernière),
 *  - puces de navigation générées en JS,
 *  - navigation au clavier (flèches gauche / droite),
 *  - balayage tactile,
 *  - `aria-hidden` sur les diapositives masquées.
 *
 * @package Nature_Reiki
 */
( function () {
    'use strict';

    /**
     * Initialise un carrousel.
     */
    function initCarrousel( carrousel ) {
        var piste = carrousel.querySelector( '[data-nature-carrousel-piste]' );
        var diapositives = carrousel.querySelectorAll(
            '[data-nature-carrousel-diapositive]'
        );
        var boutonPrecedent = carrousel.querySelector(
            '[data-nature-carrousel-precedent]'
        );
        var boutonSuivant = carrousel.querySelector(
            '[data-nature-carrousel-suivant]'
        );
        var conteneurPuces = carrousel.querySelector(
            '[data-nature-carrousel-puces]'
        );

        if ( ! piste || diapositives.length === 0 ) {
            return;
        }

        var total = diapositives.length;
        var index = 0;
        var puces = [];

        /**
         * Applique la position courante et met à jour les états ARIA.
         */
        function afficher() {
            piste.style.transform = 'translateX(' + ( -100 * index ) + '%)';

            var i;
            for ( i = 0; i < total; i++ ) {
                if ( i === index ) {
                    diapositives[ i ].removeAttribute( 'aria-hidden' );
                } else {
                    diapositives[ i ].setAttribute( 'aria-hidden', 'true' );
                }
            }

            for ( i = 0; i < puces.length; i++ ) {
                puces[ i ].classList.toggle( 'actif', i === index );
                puces[ i ].setAttribute(
                    'aria-current',
                    i === index ? 'true' : 'false'
                );
            }
        }

        /**
         * Va à une diapositive donnée, avec bouclage.
         */
        function allerA( cible ) {
            index = ( cible + total ) % total;
            afficher();
        }

        // Puces de navigation.
        if ( conteneurPuces ) {
            var j;
            for ( j = 0; j < total; j++ ) {
                var puce = document.createElement( 'button' );
                puce.type = 'button';
                puce.className = 'nature-carrousel-puce';
                puce.setAttribute(
                    'aria-label',
                    'Aller à la diapositive ' + ( j + 1 )
                );
                puce.addEventListener( 'click', ( function ( cible ) {
                    return function () {
                        allerA( cible );
                    };
                } )( j ) );
                conteneurPuces.appendChild( puce );
                puces.push( puce );
            }
        }

        if ( boutonPrecedent ) {
            boutonPrecedent.addEventListener( 'click', function () {
                allerA( index - 1 );
            } );
        }

        if ( boutonSuivant ) {
            boutonSuivant.addEventListener( 'click', function () {
                allerA( index + 1 );
            } );
        }

        // Navigation au clavier lorsque le carrousel a le focus.
        carrousel.setAttribute( 'tabindex', '0' );
        carrousel.addEventListener( 'keydown', function ( evenement ) {
            if ( evenement.key === 'ArrowLeft' ) {
                evenement.preventDefault();
                allerA( index - 1 );
            } else if ( evenement.key === 'ArrowRight' ) {
                evenement.preventDefault();
                allerA( index + 1 );
            }
        } );

        // Balayage tactile.
        var departX = null;
        carrousel.addEventListener( 'touchstart', function ( evenement ) {
            departX = evenement.touches[ 0 ].clientX;
        }, { passive: true } );

        carrousel.addEventListener( 'touchend', function ( evenement ) {
            if ( departX === null ) {
                return;
            }
            var distance = evenement.changedTouches[ 0 ].clientX - departX;
            if ( Math.abs( distance ) > 40 ) {
                allerA( distance < 0 ? index + 1 : index - 1 );
            }
            departX = null;
        } );

        afficher();
    }

    document.addEventListener( 'DOMContentLoaded', function () {
        var carrousels = document.querySelectorAll( '[data-nature-carrousel]' );
        var k;
        for ( k = 0; k < carrousels.length; k++ ) {
            initCarrousel( carrousels[ k ] );
        }
    } );

} )();
