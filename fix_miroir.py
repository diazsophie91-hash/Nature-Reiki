with open('balades.php', 'r', encoding='utf-8') as f:
    content = f.read()

old = "'titre'     => 'La forêt autrement',\n\t\t\t\t'mention'   => '',\n\t\t\t\t'image'     => 'images/feuille-chene.svg',"
new = "'titre'     => 'La forêt autrement',\n\t\t\t\t'mention'   => '',\n\t\t\t\t'image'     => 'images/miroir.png',"

if old in content:
    content = content.replace(old, new, 1)
    with open('balades.php', 'w', encoding='utf-8') as f:
        f.write(content)
    print("Done")
else:
    print("Pattern not found")