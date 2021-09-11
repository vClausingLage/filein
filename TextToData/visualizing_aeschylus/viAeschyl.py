import re
import json

# To Do 
# aus Text alle Elemente, die auf - enden mit folgendem verbinden

with open('aeschylus.txt', 'r', encoding='utf8') as file:
    text = file.read()
    text = json.loads(text)

text_str = " ".join(text)

def removeNoise(query_string):
  noise_terms = 'μὲν τὴν δὲ καὶ ὁ τῆς τὸν τῶν δ Χορός γὰρ τε ἐν τὸ ὡς τ'
  noise_terms = noise_terms.strip()
  noise_terms = noise_terms.split()
  for term in noise_terms:
    re.sub(f'{term}', '', query_string)
  return query_string

def word_count(str):
    counts = dict()
    words = str.split()
    for word in words:
        if word in counts:
            counts[word] += 1
        else:
            counts[word] = 1
    counts = sorted(counts.items(), key=lambda item: item[1])
    return counts

print(text_str)
text_str = removeNoise(text_str)
word_map = word_count(text_str)

total = len(text)
hatred = 0
love = 0


# print(total)
# print(word_map)

with open('aeschylData.json', 'w', encoding='utf8') as file:
  data = {"author": 'Aeschylus', "total": total, "hatred": hatred, "love": love}
  output = json.dumps(data, ensure_ascii=False)
  file.write(output)