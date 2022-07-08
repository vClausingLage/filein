import wordListUrl from '../urls'

const WordList = async () => {
  fetch(wordListUrl)
}

const FindPairs = () => {
  console.log('hi')

}

function MinimalComponent() {
  return(
    <>
      <p>Hi</p>
      {FindPairs()}
      {WordList}
    </>
  )
}

export default MinimalComponent