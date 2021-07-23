
// define string
let text = 'Ἐκ Διὸς ἀρχώμεσθα, τὸν οὐδέποτ’ ἄνδρες ἐῶμεν ἄρρητον· μεσταὶ δὲ Διὸς πᾶσαι μὲν ἀγυιαί, πᾶσαι δ’ ἀνθρώπων ἀγοραί, μεστὴ δὲ θάλασσα καὶ λιμένες· πάντη δὲ Διὸς κεχρήμεθα πάντες.'
// prepare string
text = text.replace(/[.,’·]/g, '')
text = text.toLowerCase()
let text_array = text.split(' ')
// iterate string
let iterator = text_array.length
for (let i = 0; i < iterator; i++) {
  console.log(text_array[i])
}

