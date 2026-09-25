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
            }

            contenu.setAttribute( 'aria-hidden', ouvrir ? 'false' : 'true' );
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
         * Configuration partagée des accordéons animés (max-height).
         * Centralise les sélecteurs du conteneur et du contenu pour éviter toute duplication,
         * afin que initToggle() et recalculerHauteurs() les réutilisent.
         */
        var accordionConfigs = [
            {
                boutonSelector: '.soin-reiki-en-savoir-plus',
                containerSelector: '.soin-reiki-card',
                contenuSelector: '.soin-reiki-details',
                animate: true
            },
            {
                boutonSelector: '.soins-reiki-accordeon-bouton',
                containerSelector: '.soins-reiki-accordeon',
                contenuSelector: '.soins-reiki-accordeon-contenu',
                animate: true
            },
            {
                boutonSelector: '.nature-carte-en-savoir-plus',
                containerSelector: '.nature-carte',
                contenuSelector: '.nature-carte-details',
                animate: true
            }
        ];

        /**
         * Recalcule la hauteur des accordéons ouverts lors du redimensionnement.
         * Utilise les configurations centralisées dans accordionConfigs pour éviter
         * toute duplication de sélecteurs.
         */
        function recalculerHauteurs() {
            for ( var a = 0; a < accordionConfigs.length; a++ ) {
                var config = accordionConfigs[ a ];
                var containers = document.querySelectorAll( config.containerSelector + '.ouvert' );
                for ( var j = 0; j < containers.length; j++ ) {
                    var contenu = containers[ j ].querySelector( config.contenuSelector );
                    if ( contenu && contenu.style.maxHeight && contenu.style.maxHeight !== '0px' ) {
                        contenu.style.maxHeight = contenu.scrollHeight + 'px';
                    }
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
                    contenuUnivers.setAttribute( 'aria-hidden', 'false' );
                }
                questions = univers.querySelectorAll( '.soins-reiki-accordeon' );
                for ( q = 0; q < questions.length; q++ ) {
                    question = questions[ q ];
                    question.classList.remove( 'ouvert' );
                    contenuQuestion = question.querySelector( '.soins-reiki-accordeon-contenu' );
                    boutonQuestion  = question.querySelector( '.soins-reiki-accordeon-bouton' );
                    if ( contenuQuestion ) {
                        contenuQuestion.style.maxHeight = '0px';
                        contenuQuestion.setAttribute( 'aria-hidden', 'true' );
                    }
                    if ( boutonQuestion ) {
                        boutonQuestion.setAttribute( 'aria-expanded', 'false' );
                    }
                }
            }
        }() );

        // Initialisation des accordéons animés via la configuration centralisée.
        for ( var a = 0; a < accordionConfigs.length; a++ ) {
            initToggle( accordionConfigs[ a ] );
        }

    } );

} )();
