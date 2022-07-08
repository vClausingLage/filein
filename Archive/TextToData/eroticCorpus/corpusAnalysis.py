import re
import json

with open('eroticCorpus.txt', 'r') as file:
    text = file.read()

dumb_words = 'Ἐν η Οὐκ Ἐπὶ παῤ ἐπεὶ παρὰ οὐχ ἀφ Ὡς τότε κάτω ὑπὸ κατὰ κἀκ Οὐδὲ δ μὰ εἴσω πάλιν οὐδ τε μέχρι μὴ πρὸς ἀπὸ οὕτω οὕτως δέ ἀντὶ περὶ μὴ ἔτι δὲ οὐδὲ καὶ ἐπὶ μὲν εἰς ἐκ ἐν ὡς πρὸ οὖν γὰρ Καὶ οὐκ μην μετὰ διὰ ἀλλ ἄν ἄρα ἅμα νῦν που ἕνεκα ἀλλὰ οὐ ὅτι Ἆρα πάνυ ἤδη ἂν ἤδη ποτε κατ̓ Ἐπεὶ ὥστε εἰ οὐν Μὴ Εἰς χ Ἀλλὰ οὔτε Νῦν'

terms = ''

fileo = 'φιλῶ φιλεῖς φιλεῖ φιλεῖτον φιλεῖτον φιλοῦμεν φιλεῖτε φιλοῦσι φιλοῦσιν φιλῶ φιλῇς φιλῇ φιλῆτον φιλῆτον φιλῶμεν φιλῆτε φιλῶσι φιλῶσιν φιλοίην φιλοῖμι φιλοίης φιλοῖς φιλοίη φιλοῖ φιλοῖτον φιλοίητον φιλοίτην φιλοιήτην φιλοῖμεν φιλοίημεν φιλοῖτε φιλοίητε φιλοῖεν φιλοίησαν φίλει φιλείτω φιλεῖτον φιλείτων φιλεῖτε φιλούντων φιλοῦμαι φιλεῖ φιλῇ φιλεῖται φιλεῖσθον φιλεῖσθον φιλούμεθα φιλεῖσθε φιλοῦνται φιλῶμαι φιλῇ φιλῆται φιλῆσθον φιλῆσθον φιλώμεθα φιλῆσθε φιλῶνται φιλοίμην φιλοῖο φιλοῖτο φιλοῖσθον φιλοίσθην φιλοίμεθα φιλοῖσθε φιλοῖντο φιλοῦ φιλείσθω φιλεῖσθον φιλείσθων	φιλεῖσθε φιλείσθων φιλεῖν φιλεῖσθαι φιλῶν	φιλούμενος φιλοῦσα φιλουμένη φιλοῦν φιλούμενον ἐφίλουν ἐφίλεις ἐφίλει ἐφιλεῖτον ἐφιλείτην ἐφιλοῦμεν ἐφιλεῖτε ἐφίλουν ἐφιλούμην ἐφιλοῦ ἐφιλεῖτο ἐφιλεῖσθον ἐφιλείσθην ἐφιλούμεθα ἐφιλεῖσθε ἐφιλοῦντο φιλήσω φιλήσεις φιλήσει φιλήσετον φιλήσετον φιλήσομεν φιλήσετε φιλήσουσι φιλήσουσιν φιλήσοιμι φιλήσοις φιλήσοι φιλήσοιτον φιλησοίτην φιλήσοιμεν φιλήσοιτε φιλήσοιεν φιλήσομαι φιλήσῃ φιλήσει φιλήσεται 	φιλήσεσθον 	φιλήσεσθον 	φιλησόμεθα 	φιλήσεσθε 	φιλήσονται φιλησοίμην 	φιλήσοιο 	φιλήσοιτο 	φιλήσοισθον 	φιλησοίσθην 	φιλησοίμεθα 	φιλήσοισθε 	φιλήσοιντο φιληθήσομαι 	φιληθήσῃ 	φιληθήσεται 	φιληθήσεσθον 	φιληθήσεσθον 	φιληθησόμεθα 	φιληθήσεσθε 	φιληθήσονται φιληθησοίμην 	φιληθήσοιο 	φιληθήσοιτο 	φιληθήσοισθον 	φιληθησοίσθην 	φιληθησοίμεθα 	φιληθήσοισθε 	φιληθήσοιντο φιλήσειν 	φιλήσεσθαι 	φιληθήσεσθαι φιλήσων 	φιλησόμενος 	φιληθησόμενος φιλήσουσα 	φιλησομένη 	φιληθησομένη φιλῆσον 	φιλησόμενον 	φιληθησόμενον ἐφίλησα 	ἐφίλησας 	ἐφίλησε ἐφίλησεν 	ἐφιλήσατον 	ἐφιλησατην 	ἐφιλήσαμεν 	ἐφιλήσατε 	ἐφίλησαν φιλήσω 	φιλήσῃς 	φιλήσῃ 	φιλήσητον 	φιλήσητον 	φιλήσωμεν 	φιλήσητε 	φιλήσωσι φιλήσωσιν φιλήσαιμι 	φιλήσειας φιλήσαις 	φιλήσειε φιλήσειεν φιλήσαι 	φιλήσαιτον 	φιλησαίτην 	φιλήσαιμεν 	φιλήσαιτε 	φιλήσειαν φιλήσαιεν φίλησον 	φιλησατω 	φιλήσατον 	φιλησατων 	  	φιλήσατε 	φιλησαντων ἐφιλησαμην 	ἐφιλήσω 	ἐφιλήσατο 	ἐφιλήσασθον 	ἐφιλησασθην 	ἐφιλησαμεθα 	ἐφιλήσασθε 	ἐφιλήσαντο φιλήσωμαι 	φιλήσῃ 	φιλήσηται 	φιλήσησθον 	φιλήσησθον 	φιλησώμεθα 	φιλήσησθε 	φιλήσωνται φιλησαίμην 	φιλήσαιο 	φιλήσαιτο 	φιλήσαισθον 	φιλησαίσθην 	φιλησαίμεθα 	φιλήσαισθε 	φιλήσαιντο φίλησαι 	φιλησασθω 	φιλήσασθον 	φιλησασθων 	  	φιλήσασθε 	φιλησασθων ἐφιλήθην 	ἐφιλήθης 	ἐφιλήθη ἐφιλήθητον ἐφιληθήτην ἐφιλήθημεν ἐφιλήθητε ἐφιλήθησαν φιληθῶ φιληθῇς φιληθῇ φιληθῆτον φιληθῆτον φιληθῶμεν φιληθῆτε φιληθῶσι φιληθῶσιν φιληθείην φιληθείης φιληθείη φιληθεῖτον φιληθείητον φιληθείτην φιληθειήτην φιληθεῖμεν φιληθείημεν φιληθεῖτε φιληθείητε φιληθεῖεν φιληθείησαν φιλήθητι φιληθήτω φιλήθητον φιληθήτων φιλήθητε φιληθέντων φιλῆσαι φιλήσασθαι φιληθῆναι φιλήσας φιλησαμενος φιληθείς φιλήσασα φιλησαμένη φιληθεῖσα φιλῆσαν φιλησαμενον φιληθέν πεφιληκέναι πεφιλῆσθαι πεφιληκώς πεφιλημένος πεφιληκυῖα πεφιλημένη πεφιληκός πεφιλημένον'
erotao = 'ἐρωτῴης ἐρωτῷτε ἐρωτήσεσθον ἐρωτᾶσθε ἐρωτῷ ἐρωτήσονται ἐρωτησοίμην ἐρωτῶ ἐρωτήσῃ ἐρωτήσω ἐρωτησοίμεθᾰ ἐρωτῴμεθᾰ ἐρωτᾷς ἐρωτᾶσθον ἐρωτῴημεν ἐρωτῷντο ἐρωτήσεσθε ἐρωτησοίτην ἐρωτήσοιο ἐρωτῴητε ἐρωτήσοιμεν ἐρωτήσομαι ἐρωτήσοιτο ἐρωτῷο ἐρωτῶσῐ ἐρωτῴητον ἐρωτσοισθον ἐρωτήσουσῐν ἐρωτήσοιμῐ ἐρωτῷς ἐρωτῷσθε ἐρωτῴτην ἐρωτῷμεν ἐρωτῴη ἐρωτᾶν ἐρωτῶσῐν ἐρωτήσοιτον ἐρωτήσοιεν ἐρωτήσοισθε ἐρωτῷσθον ἐρωτήσειν ἐρωτήσοις ἐρωτᾶσθαι ἐρωτῶμεν ἐρωτήσοιτε ἐρωτήσεις ἐρωτῶμαι ἐρωτᾶτον ἐρωτώμεθᾰ ἐρωτήσεσθαι ἐρωτήσεται ἐρωτήσοιντο ἐρωτῴην ἐρωτῴμην ἐρωτῷτο ἐρωτᾶτε ἐρωτήσει ἐρωτησόμεθᾰ ἐρωτῷτον ἐρωτᾷ ἐρωτῶνται ἐρωτησοίσθην ἐρωτῴησᾰν ἐρωτήσουσῐ ἐρωτῷεν ἐρωτῷμῐ ἐρωτήσομεν ἐρωτήσετε ἐρωτήσοι ἐρωτῳήτην ἐρωτήσετον ἐρωτῴσθην ἐρωτᾶται ἠρωτήσαιντο ἠρωτήθην ἠρωτήσειεν ἠρωτήσῃ ἠρωτηθεῖεν ἠρωτάτην ἠρωτήσησθον ἠρωτᾶσθον ἠρωτήσᾰσθον ἠρωτησαίμην ἠρωτήσᾰσθε ἠρωτήθημεν ἠρωτηθεῖτον ἠρωτηθῶσῐ ἠρωτηθῶ ἠρωτηθείημεν ἠρωτήσηται ἠρωτῶμεν ἠρωτήσᾰτο ἠρωτήσειᾰς ἠρωτηθῇς ἠρωτηθείην ἠρωτήσωσῐ ἠρωτηθείητε ἠρωτηθῶμεν ἠρωτησαίμεθᾰ ἠρωτηθῇ ἠρωτησᾰ́μεθᾰ ἠρωτηθείτην ἠρωτήσαισθε ἠρωτήθητε ἠρωτήσαιτο ἠρωτήσαιεν ἠρωτῶντο ἠρωτήσησθε ἠρωτησώμεθᾰ ἠρωτήσωμεν ἠρωτησαίσθην ἠρωτηθείης ἠρωτηθεῖμεν ἠρωτώμεθᾰ ἠρωτήσαιμεν ἠρωτησᾰ́σθην ἠρωτᾶτε ἠρωτήσαισθον ἠρωτησαίτην ἠρωτηθῆτε ἠρωτώμην ἠρωτησᾰ́μην ἠρωτήσειε ἠρωτήσωμαι ἠρωτᾶσθε ἠρωτήσαιμῐ ἠρωτων ἠρωτηθῶσῐν ἠρωτήθη ἠρωτηθείησᾰν ἠρωτησε ἠρωτᾱ́σθην ἠρωτηθείητον ἠρωτηθειήτην ἠρωτησᾰ ἠρωτηθείη ἠρωτησᾰς ἠρωτᾶτον ἠρωτήσαιτε ἠρωτήσωνται ἠρωτήσειᾰν ἠρωτησᾰν ἠρωτήθητον ἠρωτήσαι ἠρωτήσαις ἠρωτήθης ἠρωτησεν ἠρωτηθήτην ἠρωτήθησᾰν ἠρωτήσᾰτον ἠρωτήσᾰμεν ἠρωτᾱ ἠρωτήσᾰντο ἠρωτῶ ἠρωτήσω ἠρωτήσητε ἠρωτήσαιτον ἠρωτήσᾰτε ἠρωτήσωσῐν ἠρωτηθῆτον ἠρωτᾱς ἠρωτησᾰ́την ἠρωτήσῃς ἠ ρωτήσητον ἠρωτᾶτο ἠρωτήσαιο'

terms = terms + ' ' + fileo + ' ' + erotao

def removeDumbs(text, dumb_words):
    dumb_words = dumb_words.split()
    dumb_words = set(dumb_words)
    for word in dumb_words:
        text = re.sub(fr'\b{word}\b', '', text)
    return text

def prepareText(text):
  text = re.sub(r'[\[\]]', ' ', text)
  text = re.sub('\d', ' ', text)
  text = re.sub('[p‘’.:]', '', text)
  text = text.strip().split()
  return text

def fieldAnalysis(text, terms):
  terms = re.sub('\t', ' ', terms)
  terms = re.sub('\s+', ' ', terms)
  terms = terms.split()
  terms = set(terms)
  match_term = []
  for idx, el in enumerate(text):
    for term in terms:
      if (el == term):
        match_term.append([idx, text[idx-3], text[idx-2],text[idx-1], el, text[idx+1], text[idx+2], text[idx+3]])
  return match_term

# text = removeDumbs(text, dumb_words)
# text = prepareText(text)
matches = fieldAnalysis(text, terms)

with open('outcomeAnalysis.json', 'w', encoding='utf8') as file:
  data = {"fileo": matches}
  output = json.dumps(data, ensure_ascii=False)
  file.write(output)