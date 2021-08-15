import json
import re

with open('XEN.txt', 'r') as file:
  query_string = ''
  text = file.read()
  text = json.loads(text)
  for books in text:
    for paragraph in books:
      for content in paragraph:
        query_string += ' ' + content

def removeNoise(query_string):
  noise_terms = 'μὲν τὴν δὲ καὶ ὁ τῆς τὸν τῶν '
  noise_terms = noise_terms.strip()
  noise_terms = noise_terms.split()
  for term in noise_terms:
    re.sub(f'{term}', '@', query_string)
  return query_string

def word_count(str):
    counts = dict()
    words = str.split()
    for word in words:
        if word in counts:
            counts[word] += 1
        else:
            counts[word] = 1
    return counts

def sorted_query(counts):
  # return dict(sorted(counts.items(), key=lambda item: item[1]))
  return {k: v for k, v in sorted(counts.items(), key=lambda item: item[1])}

counts = word_count(query_string)
removed = removeNoise(query_string)
