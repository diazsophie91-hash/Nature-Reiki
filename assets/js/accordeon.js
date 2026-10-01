/**

* Amélioration progressive des accordéons du thème Nature & Reiki.
*
* Les accordéons utilisent le composant HTML natif <details>/<summary>.
* Ils restent donc fonctionnels sans JavaScript. Le script se limite à
* synchroniser aria-expanded lorsque JavaScript est disponible.
*
* @package Nature_Reiki
  */

( function () {
'use strict';

```
document.addEventListener( 'DOMContentLoaded', function () {
    document.documentElement.classList.replace( 'no-js', 'js' );

    var accordions = document.querySelectorAll(
        'details.le-reiki-contenu, details.soin-reiki-card-accordeon, details.soins-reiki-accordeon, details.faq-univers, details.nature-carte-accordeon, details.qui-suis-je-parcours'
    );

    var synchroniserEtat = function ( element, elementSummary ) {
        elementSummary.setAttribute( 'aria-expanded', element.open ? 'true' : 'false' );
    };

    for ( var i = 0; i < accordions.length; i++ ) {
        var accordion = accordions[ i ];
        var summary = accordion.querySelector( 'summary' );

        if ( ! summary ) {
            continue;
        }

        synchroniserEtat( accordion, summary );

        accordion.addEventListener( 'toggle', ( function ( element, elementSummary ) {
            return function () {
                synchroniserEtat( element, elementSummary );
            };
        } )( accordion, summary ) );
    }
} );
```

} )();