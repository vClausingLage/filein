import re

regex = 'ne'

string = 'Der neue Passat nennt sich Passat, ne?!'

print('erste Regex:\n')
print(re.findall(fr'\b{regex}\b', string))
print('\nZweite Regex:\n')
print(re.findall(r"\bne\b", string))