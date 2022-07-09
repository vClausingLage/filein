import React from 'react'
import wordListUrl from '../urls'

const WordList = async () => {
  fetch(wordListUrl)
  .then(response => response.text()) // TEXT or JSON format ?
  .then(data => console.log(data))
}

WordList()

const FindPairs = () => {
  console.log('hi')

}

function MinimalComponent() {
  return(
    <>
      <p>Hi</p>
      {FindPairs()}
    </>
  )
}

export default MinimalComponent