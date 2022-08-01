import sys
import io
from numpy import dot
from numpy.linalg import norm
from konlpy.tag import Okt

# 한글처리
sys.stdout = io.TextIOWrapper(sys.stdout.detach(), encoding = 'UTF-8')
sys.stderr = io.TextIOWrapper(sys.stderr.detach(), encoding = 'UTF-8')

var_query = sys.argv[1]
var_corpus1 = sys.argv[2]

okt = Okt()

def cos_sim(A, B):
  return dot(A, B)/(norm(A)*norm(B))

def morphs_sentence(text):
    text = okt.normalize(text)
    text = okt.morphs(text)
    return text

def similarity_sentence(text, answer_text):
    query_text = morphs_sentence(text)
    corpus_text = morphs_sentence(answer_text)
    vocab = {}
    cnt = 0
    for s in query_text:
        if s not in vocab:
            cnt += 1
            vocab[s] = cnt
    for s in corpus_text:
        if s not in vocab:
            cnt += 1
            vocab[s] = cnt
    max_x = max(vocab.values())
    min_x = min(vocab.values())+0.01
    minmax = max_x - min_x
    for i in vocab.keys():
        vocab[i] = (vocab[i] - min_x) / minmax
    
    max_len = max(len(query_text),len(corpus_text))
    list_query=[]
    cnt = 0
    for s in query_text:
        cnt+=1
        list_query.append(vocab[s])
    
    if cnt < max_len:
        for i in range(cnt,max_len):
            list_query.append(0.0)

    list_corpus=[]
    cnt = 0
    for s in corpus_text:
        cnt+=1
        list_corpus.append(vocab[s])
    

    if cnt < max_len:
        for i in range(cnt,max_len):
            list_corpus.append(0.0)

    return cos_sim(list_query, list_corpus)

print(var_corpus1, ",", similarity_sentence(var_query, var_corpus1))