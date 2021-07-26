import json

with open('chariton.txt', 'r') as reader:
    text = reader.read()
    jsonData = json.loads(text)
    print(jsonData)
