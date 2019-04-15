import mysql.connector as mysql
from datetime import datetime
import sys

mysql_connection = mysql.connect(user='root', password='', database='darktest')
cursor = mysql_connection.cursor()
stage=[[]]
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
    for i in range(0,21):
        if temp[i]>15 and temp[i]<36 and wind[i]<=50:
            date[i][1]=1
    for i in range(0,21):
        if(date[i][1]==1):
            str1=str1+""+date[i][0]
    print("The following dates: "+str1+" have the weather conditions most suitable for "+state+" stage")



cursor.close()

algo(str(sys.argv[1]))

