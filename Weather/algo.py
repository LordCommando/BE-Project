# import mysql.connector as mysql
# from datetime import datetime
# import sys

# mysql_connection = mysql.connect(user='root', password='', database='darktest')
# cursor = mysql_connection.cursor()
# stage=[[]]
# tp=[]
# temp= []
# wind=[]
# date= []
# sql= "select * from weather where fid = 0"

# cursor.execute(sql)
# records = cursor.fetchall()
# for row in records:
#     cel=int((row[4]-32)*5/9)
#     temp.append(cel)
#     wind.append(row[7])
#     ts = row[3]
#     output=datetime.utcfromtimestamp(ts+19800).strftime('%d/%m/%Y')
#     #print(output,"\n")
#     tp=[output,0]
#     date.append(tp)

# def algo(state):
#     str1=""
#     for i in range(0,21):
#         if temp[i]>15 and temp[i]<36 and wind[i]<=50:
#             date[i][1]=1
#     for i in range(0,21):
#         if(date[i][1]==1):
#             str1=str1+""+date[i][0]
#     print("The following dates: "+str1+" have the weather conditions most suitable for "+state+" stage")



# cursor.close()

# algo(str(sys.argv[1]))


# Example of Naive Bayes implemented from Scratch in Python
import csv
import random
import math

def loadCsv(filename):
	file = open("trial.csv", "r")
	lines = csv.reader(file)
	dataset = list(lines)
	for i in range(0,len(dataset)-1):
		dataset[i][0]=int(dataset[i][0])
		dataset[i][1]=int(dataset[i][1])
		#dataset[i][2]=int(dataset[i][2])
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
	return (1 / (math.sqrt(2*math.pi) * stdev)) * exponent

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
	for i in range(len(testSet)):
		if testSet[i][-1] == predictions[i]:
			correct += 1
	return (correct/float(len(testSet))) * 100.0

def main():
	filename = 'trial.csv'
	splitRatio = 0.67
	dataset = loadCsv(filename)
	trainingSet, testSet = splitDataset(dataset, splitRatio)
	print(len(dataset))
	print(len(trainingSet))
	print(len(testSet))
	print(type(trainingSet[0][2]))
	#print('Split {0} rows into train={1} and test={2} rows').format(len(dataset), len(trainingSet), len(testSet))
	# prepare model
	summaries = summarizeByClass(trainingSet)
	# test model
	predictions = getPredictions(summaries, testSet)
	accuracy = getAccuracy(testSet, predictions)
	print('Accuracy: {0}%').format(accuracy)

main()