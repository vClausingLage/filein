import requests
from bs4 import BeautifulSoup

pages = [' 1', '56', '103', '117', '126', '135', '141', '147', '183', '232', '274', '284', '293', '301', '309', '352', '384', '425', '464', '471', '479', '486', '494', '501', '515', '523', '537', '545', '590', '642', '693', '729', '766', '777', '788', '802', '825', '829', '833', '837', '841', '851', '854', '866', '907', '957', '1009', '1019', '1028', '1037', '1047', '1085', '1117', '1166', '1173', '1184', '1186', '1197', '1214', '1226', '1231', '1284 ']
url = 'http://www.perseus.tufts.edu/hopper/text?doc=Perseus%3Atext%3A1999.01.0089%3Acard%3D'

def getContent(page, url):
    word_list = []
    URL = url + page
    page = requests.get(URL)
    soup = BeautifulSoup(page.content, "html.parser")
    results = soup.find_all("a", class_="text")
    for result in results:
        word_list.append(result.text)
    return word_list

new_result = []
for page in pages:
    new_result.append(getContent(page, url))
    

with open('eurAndr.txt', 'w') as file:
    file.write(str(new_result))