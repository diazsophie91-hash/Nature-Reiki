import re
import sys

files_to_fix = [
    'a-venir.php',
    'accueil-guide-nature.php',
    'accueil-reiki.php',
    'animations.php',
    'balades.php',
    'front-page.php',
    'le-reiki.php',
    'me-contacter.php',
    'prendre-rendez-vous-reiki.php',
    'qui-suis-je.php',
    'soins-reiki.php'
]

for filename in files_to_fix:
    with open(filename, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remove loading="lazy" from img tags
    # Match img tags containing loading="lazy" and remove that attribute
    content = re.sub(r'(<img[^>]*?src="[^"]*?"[^>]*?)loading="lazy"\s*', r'\1', content)
    
    with open(filename, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print(f'Fixed {filename}')