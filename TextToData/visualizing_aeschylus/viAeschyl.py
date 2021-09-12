import re
import json

# To Do 

with open('aeschylus.txt', 'r', encoding='utf8') as file:
    text = file.read()
    text = json.loads(text)

text_str = " ".join(text)

def joinWords(text_str):
  text_str = re.sub('-\s', '', text_str)
  return text_str

def removeNoise(query_string):
  noise_terms = 'μὲν τὴν δὲ καὶ ὁ τῆς τὸν τῶν δ Χορός γὰρ τε ἐν τὸ ὡς τ πρὸς ἂν μὴ οὐ οὐκ ἀλλ ἐκ νῦν τὰ τις τόδ ἐπ ἐπὶ ἤδη δὴ ἐς πῶς'
  noise_terms = noise_terms.strip()
  noise_terms = noise_terms.split()
  for term in noise_terms:
    query_string = re.sub(rf'\b{term}\b', '', query_string)
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

text_str = joinWords(text_str)
text_str = removeNoise(text_str)
# text_str = word_count(text_str)

word_total = len(text)

print(text_str)

def findHate(text, query_str):
  result = []
  for query in query_str:
    result = result + re.findall(rf'\b{query}', text)
  return result

hatred_str = 'ἐχθρ φόβ στυγί βίᾳ βία θαν κακ ὀργ δεῖμ μένο'
reluctance_str = 'καταισχύνειν αἶσχος ψόγον ἀνοσίων ποινάς πόνοις δακρύων ἀλγεινὰ'
love_str = 'φίλᾷ γάμον γαμηλίου κοίτας σωτηρίου'
affecion_str = 'ἡδονὴν θέλκτορι οἰκεῖν βέλτερον προξένῳ φιλόξενον καλῶς ἁγνοῦ σέβας ὀρθοῖ εὖ ἀσφάλεια πανδίκως χρηστήρια'
affection_regex = 'εὐ syn sym xym xyn'
reluctance_regex = 'δυσ'
love = 0
hatred = 0

print(findHate(text_str, hatred_str))

with open('aeschylData.json', 'w', encoding='utf8') as file:
  data = {"author": 'Aeschylus', "total": word_total, "hatred": 0, "love": 0}
  output = json.dumps(data, ensure_ascii=False)
  file.write(output)