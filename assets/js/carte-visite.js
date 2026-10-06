/**
 * Visionneuse de carte de visite sur la page de contact.
 *
 * Utilise le lien vers l'image comme solution de repli si JavaScript
 * ou la prise en charge de <dialog> n'est pas disponible.
 *
 * @package Nature_Reiki
 */

( function () {
'use strict';

document.addEventListener( 'DOMContentLoaded', function () {
    var liens = document.querySelectorAll( '[data-carte-visite-lightbox]' );
    var dialog = document.querySelector( '[data-carte-visite-dialog]' );
    var image = dialog
        ? dialog.querySelector( '[data-carte-visite-dialog-image]' )
        : null;
    var fermer = dialog
        ? dialog.querySelector( '[data-carte-visite-close]' )
        : null;
    var lienActif = null;

    if (
        ! dialog ||
        ! image ||
        ! fermer ||
        ! liens.length ||
        'function' !== typeof dialog.showModal
    ) {
        return;
    }

    function fermerDialog() {
        if ( dialog.open ) {
            dialog.close();
        }
    }

    function ouvrirDialog( event ) {
        var miniature = this.querySelector( 'img' );

        event.preventDefault();

        image.src = this.href;
        image.alt = miniature ? miniature.alt : '';

        lienActif = this;

        dialog.showModal();
        fermer.focus();
    }

    for ( var i = 0; i < liens.length; i++ ) {
        liens[ i ].addEventListener( 'click', ouvrirDialog );
    }

    fermer.addEventListener( 'click', fermerDialog );

    dialog.addEventListener( 'click', function ( event ) {
        if ( event.target === dialog ) {
            fermerDialog();
        }
    } );

    dialog.addEventListener( 'close', function () {
        if ( lienActif ) {
            lienActif.focus();
            lienActif = null;
        }

        image.removeAttribute( 'src' );
    } );
} );

} )();
