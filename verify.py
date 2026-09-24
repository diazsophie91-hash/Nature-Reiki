import os, re
files = [f for f in os.listdir('.') if f.endswith('.php')]
for f in sorted(files):
    with open(f, 'r', encoding='utf-8') as fh:
        content = fh.read()
    for m in re.finditer(r'<section class="(reiki|nature)-hero".*?</section>', content, re.DOTALL):
        section = m.group(0)
        for pm in re.finditer(r'<p[^>]*>(.*?)</p>', section, re.DOTALL):
            ptext = pm.group(1).strip()
            if ptext.endswith('.'):
                print(f'STILL MISSING: {f}: {ptext[:80]}')
            elif '<span class="sous-titre-point">.</span>' in ptext:
                pass
            else:
                print(f'OK (wrapped): {f}: {ptext[:80]}')