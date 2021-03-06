import re
import json

print('Declare input file without file extension.')
input_text = input('Type in input file : ')
input_text = input_text + '.txt'
# search_string = 'auxilium auxilii auxilio auxilia auxiliorum castra castrorum castris copiae copiarum copiis copias'
search_string = 'iter facere'
terms = []

with open(input_text,'r') as file:
    text = file.read()
    text = json.loads(text)

def push_terms(string, terms):
    terms = string.strip().split()
    return terms
# TO DO push terms from file
terms = push_terms(search_string, terms)

def getDistributionTwoLevel(text, terms):
  distribution = []
  result = []
  for index, books in enumerate(text):
    distribution.append([index, 0, 0])
    for content in books:
      for term in terms:
        distribution[index][2] = len(content)
        result = re.findall(fr'\b{term}\b', content)
        distribution[index][1] = distribution[index][1] + len(result)
  return distribution

def getTotalOcurrences(distribution):
  sum = 0
  for element in distribution:
    sum += element[1]
  return sum

distribution = getDistributionTwoLevel(text,terms)
sum = getTotalOcurrences(distribution)

with open('data.json', 'w') as file:
  data = {"total": sum, "distribution": distribution}
  output = json.dumps(data)
  file.write(output)

# with open('distribution.csv', 'a') as file:
#    print('hello')