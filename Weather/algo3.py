import csv
import math
import random
import pickle 
import mysql.connector as mysql
from datetime import datetime
import sys
import os  


mysql_connection = mysql.connect(user='root', password='', database='darktest')
cursor = mysql_connection.cursor()
stage=[["Land preparation",15,40,50],["Seeding",15,33,20],["Seed Transplant",15,40,30],["Hand Weeding/Cultivation",15,40,50],["Irrigation",15,999,999],["Spraying",15,33,18],["Growth",15,32,30],["Threshing",15,999,25]] 
savfiles=['landprep.pickle','seed.pickle','seedtrans.pickle','handcult.pickle','irri.pickle','spray.pickle','growth.pickle','thresh.pickle']
modelfiles=['landprep.csv','seed.csv','seedtrans.csv','handcult.csv','irri.csv','spray.csv','growth.csv','thresh.csv']
summaries=['landprep','seed','seedtrans','handcult','irri','spray','growth','thresh']
tp=[]
testSets=[]
date=[]
sql= "select * from weather where fid = 0"
cursor.execute(sql)
records = cursor.fetchall()
for row in records:
    cel=float((row[4]-32)*5/9)
    wind=float(row[7])*1.6093
    tp=[cel,wind]
    print(tp)
    testSets.append(tp)
    ts = row[3]
    output=datetime.utcfromtimestamp(ts+19800).strftime('%d/%m/%Y')
    date.append(output)
cursor.close()

def loadCsv(filename):
    file = open(filename, "r")
    lines = csv.reader(file)
    dataset = list(lines)
    for i in range(len(dataset)):
        dataset[i] = [float(x) for x in dataset[i]]
    return dataset

def splitDataset(dataset, splitRatio):
    trainSize = int(len(dataset) * splitRatio)
    trainSet = []
    copy = list(dataset)
    while len(trainSet) < trainSize:
        index = random.randrange(len(copy))
        trainSet.append(copy.pop(index))
    return [trainSet, copy]

def separateByClass(dataset):
    separated = {}
    for i in range(len(dataset)):
        vector = dataset[i]
        if (vector[-1] not in separated):
            separated[vector[-1]] = []
        separated[vector[-1]].append(vector)
    return separated

def mean(numbers):
    return sum(numbers)/float(len(numbers))

def stdev(numbers):
    avg = mean(numbers)
    variance = sum([pow(x-avg,2) for x in numbers])/float(len(numbers)-1)
    return math.sqrt(variance)

def summarize(dataset):
    summaries = [(mean(attribute), stdev(attribute)) for attribute in zip(*dataset)]
    del summaries[-1]
    return summaries

def summarizeByClass(dataset):
    separated = separateByClass(dataset)
    summaries = {}
    for classValue, instances in separated.items():
        summaries[classValue] = summarize(instances)
    return summaries

def calculateProbability(x, mean, stdev):
    exponent = math.exp(-(math.pow(x-mean,2)/(2*math.pow(stdev,2))))
    return (1/(math.sqrt(2*math.pi)*stdev))*exponent

def calculateClassProbabilities(summaries, inputVector):
    probabilities = {}
    for classValue, classSummaries in summaries.items():
        probabilities[classValue] = 1
        for i in range(len(classSummaries)):
            mean, stdev = classSummaries[i]
            x = inputVector[i]
            probabilities[classValue] *= calculateProbability(x, mean, stdev)
    return probabilities

def predict(summaries, inputVector):
    probabilities = calculateClassProbabilities(summaries, inputVector)
    bestLabel, bestProb = None, -1
    for classValue, probability in probabilities.items():
        if bestLabel is None or probability > bestProb:
            bestProb = probability
            bestLabel = classValue
    return bestLabel

def getPredictions(summaries, testSet):
    predictions = []
    for i in range(len(testSet)):
        result = predict(summaries, testSet[i])
        predictions.append(result)
    return predictions

def getAccuracy(testSet, predictions):
    correct = 0
    for x in range(len(testSet)):
        if testSet[x][-1] == predictions[x]:
            correct += 1
    return (correct/float(len(testSet)))*100.0

def getStateAccuracy(testSet,predictions,state):
    correct=0
    for x in range(len(testSet)):
        if stage[state][1] <= testSet[x][0] <=stage[state][2] and testSet[x][1] <= stage[state][3]:
            correct += 1
    return (correct/float(len(testSet)))*100.0
    
def saving(classifier,state):
    f = open(savfiles[state], 'wb')
    pickle.dump(classifier, f)
    f.close()

def retriving(state):
    f = open(savfiles[state], 'rb')
    summaries = pickle.load(f)
    f.close()
    return summaries

def dates(prediction,state):
    str1=""
    for i in range(len(date)):
        if prediction[i]:
            str1=str1+" "+date[i]
    print("The following dates:"+str1+" have the weather conditions most suitable for "+stage[state][0]+" stage")        

def exist(state):
    if(os.path.isfile('./'+savfiles[state])):   
        return False
    else:
        return True

def main(state):
    if exist(state):
        filename = modelfiles[state]
        splitRatio = 0.9
        dataset = loadCsv(filename)
        trainingSet, testSet = splitDataset(dataset, splitRatio)
        # prepare model
        summaries[state] = summarizeByClass(trainingSet)
        saving(summaries[state],state)
        predictions = getPredictions(summaries[state], testSet)
        accuracy = getAccuracy(testSet, predictions)
        print(accuracy,stage[state])
    else:
        summaries[state]=retriving(state)
    #test model
    predictions = getPredictions(summaries[state], testSets)
    accuracy = getStateAccuracy(testSets,predictions,state)
    print(accuracy)
    print(predictions)
    dates(predictions,state)

main(int(sys.argv[1]))

