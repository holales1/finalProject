'''
Created on 18 oct. 2020

@author: Usuario
'''
#!/usr/bin/env python
from os import system
import spacy;
import trafilatura
import sys
import requests
import json;
def printRAW(*Text):
    RAWOut = open(1, 'w', encoding='utf8', closefd=False)
    print(*Text, file=RAWOut)
    RAWOut.flush()
    RAWOut.close()
    
url1 = sys.argv[1]
try:
    request = requests.get(url1)
    if request.status_code == 200:
        spacy.prefer_gpu()
        nlp = spacy.load('en_core_web_sm')
        downloaded = trafilatura.fetch_url(url1)
        trafilatura.extract(downloaded)
        
        about_text = trafilatura.extract(downloaded)
        about_doc = nlp(about_text)
        sentences = list(about_doc.sents)
        len(sentences)
        
        tmpSentence=''
        arraySentece=[]
        for st in sentences:
            for token in st:  
                if token.is_punct or token.tag_== 'CC':
                    arraySentece.append(tmpSentence+token.string)
                    tmpSentence=''
                else:
                    
                    tmpSentence=tmpSentence+token.string
        
        for stA in arraySentece:
            print(stA ,end = ' ,.,.,. ')
    else:
        print('Web site does not exist') 
except ValueError:
    print("Web site does not exist") 


