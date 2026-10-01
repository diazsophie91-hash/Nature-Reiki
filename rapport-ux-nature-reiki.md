# Rapport d'utilisabilité — Nature & Reiki

## Contexte
Analyse du thème WordPress à partir du skill "Laws of UX" sur les fichiers suivants :
- [header.php](header.php)
- [front-page.php](front-page.php)
- [menu-reiki.php](menu-reiki.php)
- [menu-nature.php](menu-nature.php)
- [style.css](style.css)
- [reserver.php](reserver.php)

## Verdict rapide
Le thème a une forte identité visuelle, une bonne séparation entre les deux univers et une navigation claire dans son ensemble. La plus grande faiblesse UX n’est pas le design, mais la conversion : plusieurs parcours importants sont encore semi-vides, flous ou inachevés, ce qui casse la confiance et le sens de progression.

## Points forts

### 1. Clarté de la segmentation
Le switch entre "Nature" et "Reiki" dans [header.php](header.php) est un bon exemple de Law of Similarity + Law of Proximity : deux options visuellement semblables, bien séparées par un symbole central, avec un état actif très lisible.

### 2. Hiérarchie visuelle cohérente
La page d’accueil de choix des univers dans [front-page.php](front-page.php) montre bien la logique de deux parcours complémentaires. La composition fait sens de manière immédiate : un titre, un sous-titre, puis deux blocs d’univers.

### 3. Bon support d’accessibilité de base
Le `skip-link` dans [header.php](header.php) est bien présent, et la navigation est structurée avec `aria-label` sur les menus dans [menu-reiki.php](menu-reiki.php) et [menu-nature.php](menu-nature.php). C’est un point positif selon les principes de baselines d’accessibilité et d’anticipation de parcours.

### 4. Cohérence sur les univers
La structure des pages d’accueil [accueil-reiki.php](accueil-reiki.php) et [accueil-guide-nature.php](accueil-guide-nature.php) est homogène. Cela aide la mémorisation et respecte les principes de mental model et de chunking.

## Points de friction UX

### 1. Parcours de réservation bloqué
Le fichier [reserver.php](reserver.php) affiche explicitement : "Page en construction, veuillez me contacter par e-mail". Cela crée une rupture forte sur l’axe Goal-Gradient / Peak-End / Mental Model : le site propose une action de réservation, mais la valeur n’est pas livrée.

Impact :
- perte de confiance
- interruption du parcours d’achat / de prise de contact
- mauvais sentiment de progression pour l’utilisateur

### 2. Le texte des deux cartes ne guide pas assez le choix
La page d’accueil de choix des univers dans [front-page.php](front-page.php) a une bonne mécanique de segmentation, mais le message des cartes lui-même est incomplet sur le plan décisionnel.

- La carte Nature dit : "Balades • Cuisine sauvage • Animations" et "Explorez, observez et émerveillez-vous au cœur de la nature." Cela décrit des activités et un style de vécu, mais pas un cadre clair : pour qui ? pour quel besoin ?
- La carte Reiki dit : "Soins énergétiques" et "Réharmonisation physique, émotionnelle, mentale et spirituelle." Cela est plus orienté bénéfice, mais il manque une promesse de résultat plus concrète et un déclencheur de décision immédiate.

Le problème n’est pas la présence de deux univers, c’est l’absence de vérité de tri : le visiteur doit encore deviner lequel correspond à son besoin. Or le decision-making repose sur la clarté du matching entre le besoin du visiteur et la promesse de l’offre.

Selon Hick’s Law et Choice Overload, il y a un bon nombre d’options limitées, mais aucun signal puissant de recommandation. Le texte des cartes parle de contenu et de bénéfice, sans poser explicitement un scénario de décision utile.

### 3. Navigation assez longue pour une boutique de services/persona
Les menus dans [menu-reiki.php](menu-reiki.php) et [menu-nature.php](menu-nature.php) comptent 7 à 8 items. Ce n’est pas catastrophique, mais c’est au point de saturation visuelle sur mobile, surtout avec des libellés longs comme "Qui suis-je ?", "Prendre rendez-vous", "Me contacter".

Risque :
- écrasement de la hiérarchie
- menu trop dense sur petits écrans
- friction extra sur mobile

### 4. Lien Facebook générique et potentiellement vide
Dans [header.php](header.php), le bouton Facebook pointe vers `https://www.facebook.com/` sans identifiant de page ciblé. C’est une mauvaise mise en œuvre du principe de confiance et de clarté. L’utilisateur arrive sur une page générique au lieu d’un profil/service fiable.

### 5. Focus clavier et états d’interaction à renforcer
Le CSS dans [style.css](style.css) met beaucoup de soin sur le hover et les états du switch, mais il manque de repères de focus plus homogènes sur les cartes de contenus et les CTA. La règle de Selective Attention / Von Restorff n’est pas complètement exploitée pour guider l’utilisateur vers le bon prochain pas.

## Analyse selon les lois UX

### Perception et grouping
- Bonne séparation visuelle entre les univers.
- Bon usage de la proximité et de la similarité dans les cartes.
- Point faible : le thème ne fait pas assez de différenciation entre le CTA principal et les éléments secondaires.

### Decision making
- La page d’accueil est claire et peu chargée.
- Le vrai manque est l’orientation de décision : l’utilisateur ne sait pas exactement quel chemin l’aide le plus vite.
- Le texte des cartes, en particulier dans [front-page.php](front-page.php), est structurément bon pour créer de la chaleur et du branding, mais insuffisant pour guider la décision de manière objective. Nature décrit un univers d’expériences, Reiki décrit un univers de transformation intérieure. L’utilisateur doit faire le lien entre ces promesses et son besoin personnel.
- En pratique, la décision fonctionne davantage comme un choix esthétique que comme un choix orienté par une promesse claire. Il manque un mini-brief de matching : "Si vous cherchez ... cliquez ici".

### Memory and learning
- Les univers sont faciles à mémoriser puisqu’ils sont distincts et fortement signalés.
- La navigation est cohérente, mais la démarche de prise de contact / réservation reste peu fiable et peu mémorisable.

### Interaction and motor
- Les zones de clic sont globalement correctes.
- Sur mobile, la navigation horizontale risque d’être dense et peu confortable.
- Le bouton retour en haut est un bon ajout pour le confort mais ne remplace pas un parcours de conversion simple.

### Behavior and expectation
- Le design suit une logique spirituelle et naturelle, ce qui correspond au brand.
- En revanche, les attentes de conversion et de clarté des événements clés ne sont pas pleinement satisfaites.

## Recommandations prioritaires

1. Rendre la réservation visible et crédible
   - remplacer le message “Page en construction” par un vrai parcours, même simple
   - ou exposer une date, une étape, un formulaire de contact, ou un calendrier

2. Clarifier le CTA principal sur chaque univers
   - “Réserver”, “Prendre rendez-vous” ou “Me contacter” doit être plus dominant que les contenus secondaires

3. Réduire la densité du menu mobile
   - mettre en place un menu compressé ou un “Plus” pour les éléments secondaires

4. Corriger le lien Facebook
   - pointer vers la bonne page ou l’enlever si le compte n’est pas exploité

5. Accentuer la hiérarchie sur la landing page
   - donner un repère immédiat : “Vous cherchez une séance, une balade ou une animation ?”

## Score global
7,5/10

## Conclusion
Le thème a un fort potentiel de branding et une bonne cohérence visuelle. Ce n’est pas un mauvais site en terme de style ; le principal défaut est l’absence de parcours de conversion crédibles et de hiérarchie de décision suffisamment orientée. En appliquant quelques changements sur la réservation, le CTA et la navigation mobile, le site gagnerait rapidement en confiance et en efficacité.
