import json

with open('achilleus.txt', 'r') as reader:
    text = reader.read()
    jsonData = json.loads(text)
    print(jsonData)
