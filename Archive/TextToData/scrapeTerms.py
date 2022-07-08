import requests
from bs4 import BeautifulSoup

URL = "https://en.wiktionary.org/wiki/%CF%86%CE%B9%CE%BB%CE%AD%CF%89"
page = requests.get(URL)
soup = BeautifulSoup(page.content, "html.parser")
results = soup.findAll('a')

print(results)