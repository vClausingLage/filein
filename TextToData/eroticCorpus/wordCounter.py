import re

string = 'hello - world.'

def counter(string):
    pattern = '[.:,;-]\s+'
    string = re.sub(pattern, '', string)
    return string

string = counter(string)
print(string)