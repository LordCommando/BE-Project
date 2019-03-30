import mysql.connector as mysql
from datetime import datetime
import sys

mysql_connection = mysql.connect(user='root', password='', database='darktest')
cursor = mysql_connection.cursor()
stage=[["Land preparation",15,40,50],["Seeding",15,33,20],["Seed Transplant",15,40,30],["Hand Weeding/Cultivation",15,40,50],["Irrigation",15,999,999],["Spraying",15,33,18],["Growth",15,32,30],["Threshing",15,999,25]]
tp=[]
temp= []
wind=[]
date= []
sql= "select * from weather where fid = 0"

cursor.execute(sql)
records = cursor.fetchall()
for row in records:
    cel=int((row[4]-32)*5/9)
    temp.append(cel)
    wind.append(row[7])
    ts = row[3]
    output=datetime.utcfromtimestamp(ts+19800).strftime('%d/%m/%Y')
    #print(output,"\n")
    tp=[output,0]
    date.append(tp)

def algo(state):
    str1=""
    for i in range(0,7):
        if temp[i]>stage[int(state)][1] and temp[i]<stage[int(state)][2] and wind[i]<=stage[int(state)][3]:
            date[i][1]=1
    for i in range(0,7):
        if(date[i][1]==1):
            str1=str1+" "+date[i][0]
    print("The following dates: "+str1+" have the weather conditions most suitable for "+stage[int(state)][0]+" stage")



cursor.close()

algo(str(sys.argv[1]))