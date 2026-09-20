import pathlib

p = pathlib.Path(r'c:\Users\Kahlan\Local Sites\nature---reiki\app\public\wp-content\themes\nature-reiki\balades.php')
data = p.read_bytes()

old = b'''\t\t<?php\n\t\t$diapositives = array(\n\t\t\tarray(\n\t\t\t\t'texte'   => 'On avance doucement : c'est en ralentissant que l'on remarque le plus de choses.',\n\t\t\t\t'legende' => 'Le rythme de la balade',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'texte'   => 'Reconnaître une plante, c'est d'abord la regarder longuement, sous tous les angles.',\n\t\t\t\t'legende' => 'Observer avant de nommer',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'texte'   => 'Une cueillette se fait avec mesure : on ne prélève jamais tout ce que l'on trouve.',\n\t\t\t\t'legende' => 'Cueillir avec respect',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'texte'   => 'Chaque saison redessine le même chemin : rien n'est jamais tout à fait pareil.',\n\t\t\t\t'legende' => 'Revenir au fil des saisons',\n\t\t\t),\n\t\t);\n\n\t\t$total_diapositives = count( $diapositives );\n\t\t?>'''

print('Old in data:', old in data)

if old in data:
    new = b'''\t\t<?php\n\t\t$diapositives = array(\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/celte.jpg',\n\t\t\t\t'legende' => 'Sur les pas des Celtes à nos jours',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/ami-arbre.jpg',\n\t\t\t\t'legende' => 'Mon ami l'arbre',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/foret-autrement.png',\n\t\t\t\t'legende' => 'La forêt autrement',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/traces.jpg',\n\t\t\t\t'legende' => 'Traces et indices en forêt',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/cuisine.jpg',\n\t\t\t\t'legende' => 'Cuisine sauvage',\n\t\t\t),\n\t\t\tarray(\n\t\t\t\t'image'   => 'images/carriere.jpg',\n\t\t\t\t'legende' => 'Découverte carrières',\n\t\t\t),\n\t\t);\n\n\t\t$total_diapositives = count( $diapositives );\n\t\t?>'''
    new_data = data.replace(old, new, 1)
    p.write_bytes(new_data)
    print('SUCCESS: Array replaced')
else:
    print('FAILURE: Old text not found')
