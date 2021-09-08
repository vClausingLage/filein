import requests
from bs4 import BeautifulSoup

# pages = [1, 40, 83, 104, 122, 140, 160, 167, 184, 192, 205, 218, 228, 238, 248, 258, 281, 320, 355, 367, 385, 403, 420, 437, 456, 475, 488, 538, 583, 613, 636, 681, 699, 716, 727, 737, 750, 763, 772, 782, 810, 855, 887, 914, 944, 975, 988, 1001, 1017, 1035, 1072, 1076, 1080, 1085, 1090, 1095, 1100, 1107, 1114, 1125, 1136, 1146, 1156, 1167, 1178, 1202, 1242, 1295, 1331, 1343, 1344, 1345, 1346, 1348, 1372, 1407, 1412, 1426, 1431, 1448, 1455, 1462, 1468, 1475, 1481, 1489, 1497, 1505, 1513, 1521, 1531, 1537, 1551, 1560, 1567, 1577, 1617]

pages = [1, 40]

total = []

def getContent(page):
    word_list = []
    URL = "http://www.perseus.tufts.edu/hopper/text?doc=Perseus%3Atext%3A1999.01.0003%3Acard%3D" + str(page)
    page = requests.get(URL)
    soup = BeautifulSoup(page.content, "html.parser")
    results = soup.find_all("a", class_="text")
    for result in results:
        word_list.append(result.text)
    return word_list

new_result = []
for el in pages:
    new_result.append(getContent(el))
    

with open('aeschylus.txt', 'w') as file:
    file.write(str(new_result))