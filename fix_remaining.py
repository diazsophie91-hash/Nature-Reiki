import re
import sys

def fix_file(filename, line_numbers):
    """Remove loading="lazy" from specific line numbers."""
    with open(filename, 'r', encoding='utf-8') as f:
        lines = f.readlines()
    
    for line_num in line_numbers:
        if line_num <= len(lines):
            if 'loading="lazy"' in lines[line_num - 1]:
                lines[line_num - 1] = lines[line_num - 1].replace('loading="lazy"', '')
                print(f'  Removed from line {line_num} in {filename}')
    
    with open(filename, 'w', encoding='utf-8') as f:
        f.writelines(lines)

print("Fixing remaining files...")
print()

# me-contacter.php: lines 38 and 53 (hero decoration images)
print("Fixing me-contacter.php...")
fix_file('me-contacter.php', [38, 53])

# prendre-rendez-vous-reiki.php: line 39 (hero lotus.svg)
print("Fixing prendre-rendez-vous-reiki.php...")
fix_file('prendre-rendez-vous-reiki.php', [39])

# qui-suis-je.php: lines 69, 83, 102, 116 (hero decoration images)
# These correspond to the 4 decoration images in the two variant branches
print("Fixing qui-suis-je.php...")
fix_file('qui-suis-je.php', [69, 83, 102, 116])

# soins-reiki.php: line 39 (hero lotus.svg)
print("Fixing soins-reiki.php...")
fix_file('soins-reiki.php', [39])

print()
print("Done!")