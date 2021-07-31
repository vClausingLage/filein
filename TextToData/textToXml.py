import re

with open('Chariton_Buch_8.txt', 'r') as reader:
    text = reader.read()
    # remove empty lines
    lines = text.split('\n')
    removed_empty_lines = [line for line in lines if line.strip() != '']
    text = ""
    for line in removed_empty_lines:
        text += line + '\n'
    # # remove page count
    text = re.sub('\[\s?p.\s\d{1,3}\s?\]', '', text)
    # make chapters and paragraphs
    paragraphs = text.split('\n')
    text = ''
    for line in paragraphs:
        if len(line) > 0:
            line = '\n<paragraph> ' + line + '</paragraph>\n'
            text += line
    chapters = text.split('\n')
    text = ''
    for line in chapters:
        if len(line) > 0:
            line = '<chapter>' + line + '</chapter>'
            text += line
    text = re.sub('\[\d+\]', '</paragraph><paragraph>', text)
    text = '<book>' + text + '</book>'
    # write
    file = open("chariton.txt", "a")
    file.write(text)
    file.close()
