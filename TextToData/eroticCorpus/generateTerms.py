# remove diacrictics !
# check for duplicates (set)
# include participles, imperatives, infinitives !
# include perfect, plusqumaperfect

def aContracts(averb):
    endingsPresent = 'ῶ ᾷς ᾷ ῶμεν ᾶτε ῶσῐ ῶσῐν ᾶτον ῶμαι ᾶται ᾶσθον ώμεθᾰ ᾶσθε ῶνται ῴην ῴης ῴη ῷτον ῴτην ῷμεν ῷτε ῷεν ῷμῐ ῷς ῷ ῴητον ῳήτην ῴημεν ῴητε ῴησᾰν ῴμην ῷο ῷτο ῷσθον ῴσθην ῴμεθᾰ ῷσθε ῷντο ᾶν ᾶσθαι ήσω ήσεις ήσει ήσετον ήσετον ήσομεν ήσετε ήσουσῐν ήσουσῐ ήσοιμῐ ήσοις ήσοι ήσοιτον ησοίτην ήσοιμεν ήσοιτε ήσοιεν ήσομαι ήσῃ ήσει ήσεται ήσεσθον ησόμεθᾰ ήσεσθε ήσονται ήσοιντο ήσοισθε ησοίμεθᾰ ησοίσθην σοισθον ήσοιτο ήσοιο ησοίμην ήσειν ήσεσθαι'
    endingsPresent = endingsPresent.split()
    endingsPresent = set(endingsPresent)
    endingsPast = 'ων ᾱς ᾱ ᾶτον άτην ῶμεν ᾶτε ων ώμην ῶ ᾶτο ᾶσθον ᾱ́σθην ώμεθᾰ ᾶσθε ῶντο ησᾰ ησᾰς ησε ησεν ήσᾰτον ησᾰ́την ήσᾰμεν ήσᾰτε ησᾰν ησᾰ́μην ήσω ήσᾰτο ήσᾰσθον ησᾰ́σθην ησᾰ́μεθᾰ ήσᾰσθε ήσᾰντο ήθην ήθης ήθη ήθητον ηθήτην ήθημεν ήθητε ήθησᾰν ήσω ήσῃς ήσῃ ήσητον ήσωμεν ήσητε ήσωσῐν ήσωσῐ ήσαιμῐ ήσειᾰς ήσαις ήσειεν ήσειε ήσαι ήσαιτον ησαίτην ήσαιμεν ήσαιτε ήσειᾰν ήσαιεν ησᾰ́μην ήσω ήσᾰτο ήσᾰσθον ησᾰ́σθην ησᾰ́μεθᾰ ήσᾰσθε ήσᾰντο ήσωμαι ήσῃ ήσηται ήσησθον ησώμεθᾰ ήσησθε ήσωνται ησαίμην ήσαιο ήσαιτο ήσαισθον ησαίσθην ησαίμεθᾰ ήσαισθε ήσαιντο ηθῶ ηθῇς ηθῇ ηθῆτον ηθῶμεν ηθῆτε ηθῶσῐ ηθῶσῐν ηθείην ηθείης ηθείη ηθεῖτον ηθείητον ηθείτην ηθειήτην ηθεῖμεν ηθείημεν ηθείητε ηθεῖεν ηθείησᾰν'
    endingsPast = endingsPast.split()
    endingsPast = set(endingsPast)
    # endings = set(endings)
    averbs = []
    [averbs.append(averb + x) for x in endingsPresent]
    if (averb[0] == 'ἐ' or averb[0] == 'ἀ'):
        averb = list(averb)
        averb[0] = 'ἠ'
        averb = ''.join(averb)
        [averbs.append(averb + x) for x in endingsPast]
    else:
        [averbs.append(averb + x) for x in endingsPast]
    return averbs

averb = 'ἐρωτ'
averbs = aContracts(averb)
print(averbs)