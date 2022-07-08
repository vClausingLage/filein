const express = require('express')
const app = express()
const PORT = process.env.PORT || 4000

app.get('/', (req,res) => {
  res.send('moin')
})

app.get('/list', (req, res) => {
  res.send('list is here')
})

app.listen(PORT, () => {
  console.log(`server running on port ${PORT}`)
})