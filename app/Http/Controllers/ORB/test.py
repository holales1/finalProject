from os import system
import sys
from sentence_transformers import SentenceTransformer, util
import torch
import json

with open('public\myfile.json') as f:
    distros_dict = json.load(f)

embedder = SentenceTransformer('distilbert-base-nli-stsb-mean-tokens')

# Corpus with example sentences
corpus = distros_dict['url1']
corpus_embeddings = embedder.encode(corpus, convert_to_tensor=True)

# Query sentences:
queries = distros_dict['url2']


# Find the closest 5 sentences of the corpus for each query sentence based on cosine similarity
top_k = 1
sentences=[]
sentencesScore=[]
querySentences=[]
for query in queries:
    query_embedding = embedder.encode(query, convert_to_tensor=True)
    cos_scores = util.pytorch_cos_sim(query_embedding, corpus_embeddings)[0]
    cos_scores = cos_scores.cpu()

    #We use torch.topk to find the highest 5 scores
    top_results = torch.topk(cos_scores, k=top_k)


    for score, idx in zip(top_results[0], top_results[1]):
        sentences.append(corpus[idx])
        sentencesScore.append(round(float(score*100),2))
        querySentences.append(query)
    
print(json.dumps({'sentences':sentences,'score':sentencesScore, 'querySentences':querySentences}))