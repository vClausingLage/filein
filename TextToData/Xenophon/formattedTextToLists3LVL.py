import re
import json

print('Declare input file without file extension.')
input_text = input('Type in input file : ')
input_text = input_text + '.txt'
search_string = ''
fileo = 'φιλῶ φιλεῖς φιλεῖ φιλεῖτον φιλεῖτον φιλοῦμεν φιλεῖτε φιλοῦσι φιλοῦσιν φιλῶ φιλῇς φιλῇ 	φιλῆτον 	φιλῆτον 	φιλῶμεν 	φιλῆτε 	φιλῶσι φιλῶσιν φιλοίην φιλοῖμι 	φιλοίης φιλοῖς φιλοίη φιλοῖ φιλοῖτον φιλοίητον φιλοίτην φιλοιήτην φιλοῖμεν φιλοίημεν 	φιλοῖτε φιλοίητε 	φιλοῖεν φιλοίησαν φίλει 	φιλείτω 	φιλεῖτον 	φιλείτων 	  	φιλεῖτε 	φιλούντων  	φιλοῦμαι 	φιλεῖ φιλῇ 	φιλεῖται 	φιλεῖσθον 	φιλεῖσθον 	φιλούμεθα 	φιλεῖσθε 	φιλοῦνται	φιλῶμαι 	φιλῇ 	φιλῆται 	φιλῆσθον 	φιλῆσθον 	φιλώμεθα 	φιλῆσθε 	φιλῶνται 	φιλοίμην 	φιλοῖο 	φιλοῖτο 	φιλοῖσθον 	φιλοίσθην 	φιλοίμεθα 	φιλοῖσθε 	φιλοῖντο 	  	φιλοῦ 	φιλείσθω 	φιλεῖσθον 	φιλείσθων 	  	φιλεῖσθε 	φιλείσθων 	φιλεῖν 	φιλεῖσθαι φιλῶν	φιλούμενος φιλοῦσα 	φιλουμένη φιλοῦν 	φιλούμενον ἐφίλουν 	ἐφίλεις 	ἐφίλει 	ἐφιλεῖτον 	ἐφιλείτην 	ἐφιλοῦμεν 	ἐφιλεῖτε 	ἐφίλουν ἐφιλούμην 	ἐφιλοῦ 	ἐφιλεῖτο 	ἐφιλεῖσθον 	ἐφιλείσθην 	ἐφιλούμεθα 	ἐφιλεῖσθε 	ἐφιλοῦντο φιλήσω 	φιλήσεις 	φιλήσει 	φιλήσετον 	φιλήσετον 	φιλήσομεν 	φιλήσετε 	φιλήσουσι φιλήσουσιν φιλήσοιμι 	φιλήσοις 	φιλήσοι 	φιλήσοιτον 	φιλησοίτην 	φιλήσοιμεν 	φιλήσοιτε 	φιλήσοιεν φιλήσομαι 	φιλήσῃ φιλήσει 	φιλήσεται 	φιλήσεσθον 	φιλήσεσθον 	φιλησόμεθα 	φιλήσεσθε 	φιλήσονται φιλησοίμην 	φιλήσοιο 	φιλήσοιτο 	φιλήσοισθον 	φιλησοίσθην 	φιλησοίμεθα 	φιλήσοισθε 	φιλήσοιντο φιληθήσομαι 	φιληθήσῃ 	φιληθήσεται 	φιληθήσεσθον 	φιληθήσεσθον 	φιληθησόμεθα 	φιληθήσεσθε 	φιληθήσονται φιληθησοίμην 	φιληθήσοιο 	φιληθήσοιτο 	φιληθήσοισθον 	φιληθησοίσθην 	φιληθησοίμεθα 	φιληθήσοισθε 	φιληθήσοιντο φιλήσειν 	φιλήσεσθαι 	φιληθήσεσθαι φιλήσων 	φιλησόμενος 	φιληθησόμενος φιλήσουσα 	φιλησομένη 	φιληθησομένη φιλῆσον 	φιλησόμενον 	φιληθησόμενον ἐφίλησα 	ἐφίλησας 	ἐφίλησε ἐφίλησεν 	ἐφιλήσατον 	ἐφιλησατην 	ἐφιλήσαμεν 	ἐφιλήσατε 	ἐφίλησαν φιλήσω 	φιλήσῃς 	φιλήσῃ 	φιλήσητον 	φιλήσητον 	φιλήσωμεν 	φιλήσητε 	φιλήσωσι φιλήσωσιν φιλήσαιμι 	φιλήσειας φιλήσαις 	φιλήσειε φιλήσειεν φιλήσαι 	φιλήσαιτον 	φιλησαίτην 	φιλήσαιμεν 	φιλήσαιτε 	φιλήσειαν φιλήσαιεν φίλησον 	φιλησατω 	φιλήσατον 	φιλησατων 	  	φιλήσατε 	φιλησαντων ἐφιλησαμην 	ἐφιλήσω 	ἐφιλήσατο 	ἐφιλήσασθον 	ἐφιλησασθην 	ἐφιλησαμεθα 	ἐφιλήσασθε 	ἐφιλήσαντο φιλήσωμαι 	φιλήσῃ 	φιλήσηται 	φιλήσησθον 	φιλήσησθον 	φιλησώμεθα 	φιλήσησθε 	φιλήσωνται φιλησαίμην 	φιλήσαιο 	φιλήσαιτο 	φιλήσαισθον 	φιλησαίσθην 	φιλησαίμεθα 	φιλήσαισθε 	φιλήσαιντο φίλησαι 	φιλησασθω 	φιλήσασθον 	φιλησασθων 	  	φιλήσασθε 	φιλησασθων ἐφιλήθην 	ἐφιλήθης 	ἐφιλήθη 	ἐφιλήθητον 	ἐφιληθήτην 	ἐφιλήθημεν 	ἐφιλήθητε 	ἐφιλήθησαν φιληθῶ 	φιληθῇς 	φιληθῇ 	φιληθῆτον 	φιληθῆτον 	φιληθῶμεν 	φιληθῆτε 	φιληθῶσι φιληθῶσιν  φιληθείην 	φιληθείης 	φιληθείη 	φιληθεῖτον φιληθείητον 	φιληθείτην φιληθειήτην 	φιληθεῖμεν φιληθείημεν 	φιληθεῖτε φιληθείητε 	φιληθεῖεν φιληθείησαν φιλήθητι 	φιληθήτω 	φιλήθητον 	φιληθήτων 	  	φιλήθητε 	φιληθέντων φιλῆσαι 	φιλήσασθαι 	φιληθῆναι φιλήσας 	φιλησαμενος 	φιληθείς φιλήσασα 	φιλησαμένη 	φιληθεῖσα φιλῆσαν 	φιλησαμενον 	φιληθέν πεφιληκέναι 	πεφιλῆσθαι πεφιληκώς 	πεφιλημένος πεφιληκυῖα 	πεφιλημένη πεφιληκός 	πεφιλημένον'
# https://en.wiktionary.org/wiki/%CF%86%CE%B9%CE%BB%CE%AD%CF%89
# https://en.wiktionary.org/wiki/%E1%BC%90%CF%81%CE%AC%CF%89
search_string = fileo
terms = []

with open(input_text,'r') as file:
    text = file.read()
    text = json.loads(text)

def push_terms(string, terms):
    terms = string.strip().split()
    terms = set(terms)
    return terms
# TO DO push terms from file
terms = push_terms(search_string, terms)

def getDistributionThreeLevel(text, terms):
  distribution = []
  result = []
  for index, books in enumerate(text):
    distribution.append([index, 0, 0])
    for paragraph in books:
      for content in paragraph:
        for term in terms:
          distribution[index][1] = len(content)
          result = re.findall(fr'\b{term}\b', content)
          distribution[index][2] = distribution[index][2] + len(result)
  return distribution

def getTotalOcurrences(distribution):
  sum = 0
  for element in distribution:
    sum += element[2]
  return sum

def getSurroundigs(text, terms):
  match_term = []
  string = ''
  # prepare text
  for books in text:
    for paragraphs in books:
      for content in paragraphs:
        string += ' '
        string += content
  string = ' '.join(string.split())
  string = string.split()
  # search text
  for idx, el in enumerate(string):
    for term in terms:
      if (el == term):
        match_term.append([string[idx-2],string[idx-1], el, idx, string[idx+1], string[idx+2]])
      #match_term.append([x for x in el if re.search(f'{term}', x)])
  return match_term

distribution = getDistributionThreeLevel(text,terms)
sum = getTotalOcurrences(distribution)
match_term = getSurroundigs(text, terms)
print(match_term)

with open('data.json', 'w', encoding="utf8") as file:
  data = {"total": sum, "distribution": distribution, "surroundings": match_term}
  output = json.dumps(data, ensure_ascii=False)
  file.write(output)