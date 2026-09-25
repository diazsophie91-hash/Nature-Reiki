/**
 * Gestion centralisée des accordéons du thème Nature & Reiki.
 *
 * Un seul mécanisme de toggle est utilisé pour tous les types
 * d'accordéons, configuré via un objet `config` (sélecteur du bouton,
 * sélecteur du contenu, mode d'animation).
 *
 * Types d'accordéons pris en charge :
 *  - .le-reiki-toggle              : accordéon simple (toggle bouton + contenu frère)
 *  - .soin-reiki-en-savoir-plus    : accordéon "En savoir plus" des cartes de soins
 *  - .soins-reiki-accordeon-bouton : accordéon d'informations détaillées
 *  - .faq-univers-bouton           : bouton d'ouverture/fermeture d'un univers en FAQ
 *
 * @package Nature_Reiki
 */
( function () {
    'use strict';

    document.addEventListener( 'DOMContentLoaded', function () {

        /**
         * Met à jour l'état (affiché/masqué) du contenu d'un accordéon.
         */
        function setContenuState( contenu, ouvrir, animate ) {
            if ( ! contenu ) {
                return;
            }
            if ( animate ) {
                contenu.style.maxHeight = ouvrir ? contenu.scrollHeight + 'px' : '0px';
            } else {
                contenu.hidden = ! ouvrir;
            contenuto.setAttribute("aria-hidden", ! ouvrir);
            }
        }

        /**
         * Initialise un type d'accordéon en branchant un écouteur `click`
         * sur chaque bouton correspondant.
         */
        function initToggle( config ) {
            var boutons = document.querySelectorAll( config.boutonSelector );
            var i, bouton;
            for ( i = 0; i < boutons.length; i++ ) {
                bouton = boutons[ i ];
                bouton.addEventListener( 'click', ( function ( btn ) {
                    return function () {
                        var container = config.containerSelector
                            ? btn.closest( config.containerSelector )
                            : btn.parentElement;
                        if ( ! container ) {
                            return;
                        }
                        var contenu = config.contenuSelector
                            ? container.querySelector( config.contenuSelector )
                            : btn.nextElementSibling;
                        if ( ! contenu ) {
                            return;
                        }
                        var estOuvert = container.classList.contains( 'ouvert' );
                        var nouvelEtat = ! estOuvert;
                        container.classList.toggle( 'ouvert', nouvelEtat );
                        btn.setAttribute( 'aria-expanded', nouvelEtat ? 'true' : 'false' );
                        setContenuState( contenu, nouvelEtat, !! config.animate );
                    };
                } )( bouton ) );
            }
        }

        /**
         * Recalcule la hauteur des accordéons ouverts lors du redimensionnement.
         */
        function recalculerHauteurs() {
            var ouverts = document.querySelectorAll( '.ouvert' );
            var j, container, contenu;
            for ( j = 0; j < ouverts.length; j++ ) {
                container = ouverts[ j ];
                contenu = null;
                if ( container.classList.contains( 'soin-reiki-card' ) ) {
                    contenu = container.querySelector( '.soin-reiki-details' );
                } else if ( container.classList.contains( 'soins-reiki-accordeon' ) ) {
                    contenu = container.querySelector( '.soins-reiki-accordeon-contenu' );
                } else if ( container.classList.contains( 'nature-carte' ) ) {
                    contenu = container.querySelector( '.nature-carte-details' );
                }
                if ( contenu && contenu.style.maxHeight && contenu.style.maxHeight !== '0px' ) {
                    contenu.style.maxHeight = contenu.scrollHeight + 'px';
                }
            }
        }

        var resizeTimer;
        window.addEventListener( 'resize', function () {
            clearTimeout( resizeTimer );
            resizeTimer = setTimeout( recalculerHauteurs, 150 );
        } );

        // Accordéon simple "Le Reiki" — animé via CSS (.ouvert).
        initToggle( { boutonSelector: '.le-reiki-toggle' } );

        // Accordéon "En savoir plus" des cartes de soins — animé via max-height.
        initToggle( {
            boutonSelector: '.soin-reiki-en-savoir-plus',
            containerSelector: '.soin-reiki-card',
            contenuSelector: '.soin-reiki-details',
            animate: true
        } );

        // Accordéons d'informations détaillées (soins-reiki) — animé via max-height.
        initToggle( {
            boutonSelector: '.soins-reiki-accordeon-bouton',
            containerSelector: '.soins-reiki-accordeon',
            contenuSelector: '.soins-reiki-accordeon-contenu',
            animate: true
        } );

        // Boutons d'ouverture/fermeture d'un univers en FAQ — utilise `hidden`.
        initToggle( {
            boutonSelector: '.faq-univers-bouton',
            containerSelector: '.faq-univers',
            contenuSelector: '.faq-univers-contenu'
        } );

        // Initialisation FAQ : les deux univers restent ouverts, leurs questions fermées.
        ( function () {
            var universList = document.querySelectorAll( '.page-faq .faq-univers' );
            var u, univers, contenuUnivers, questions, q, question, contenuQuestion, boutonQuestion;
            for ( u = 0; u < universList.length; u++ ) {
                univers = universList[ u ];
                univers.classList.add( 'ouvert' );
                contenuUnivers = univers.querySelector( '.faq-univers-contenu' );
                if ( contenuUnivers ) {
                    contenuUnivers.hidden = false;
                }
                questions = univers.querySelectorAll( '.soins-reiki-accordeon' );
                for ( q = 0; q < questions.length; q++ ) {
                    question = questions[ q ];
                    question.classList.remove( 'ouvert' );
                    contenuQuestion = question.querySelector( '.soins-reiki-accordeon-contenu' );
                    boutonQuestion  = question.querySelector( '.soins-reiki-accordeon-bouton' );
                    if ( contenuQuestion ) {
                        contenuQuestion.style.maxHeight = '0px';
                    }
                    if ( boutonQuestion ) {
                        boutonQuestion.setAttribute( 'aria-expanded', 'false' );
                    }
                }
            }
        }() );

        // Accordéon « En savoir plus » des cartes Nature — animé via max-height.
        initToggle( {
            boutonSelector: '.nature-carte-en-savoir-plus',
            containerSelector: '.nature-carte',
            contenuSelector: '.nature-carte-details',
            animate: true
        } );

    } );

} )();
