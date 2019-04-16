import requests
import json
import mysql.connector as mysql
import sys


url="https://api.darksky.net/forecast/69c10ffc962bfdca265a49d656c26eb9/19.1608429,72.9946485?exclude=currently,hourly"
#url="https://api.darksky.net/forecast/69c10ffc962bfdca265a49d656c26eb9/" + str(sys.argv[1]) + ',' + str(sys.argv[2])+ '?exclude=currently,hourly'
print(url)
response = requests.get(url)
jsongeocode = response.text
y=json.loads(jsongeocode)

mysql_connection = mysql.connect(user='root', password='', database='darktest')
cursor = mysql_connection.cursor()

sql= "INSERT into weather(i, time, temp, humidity, pressure, wind, summary) values (%s,%s,%s,%s,%s,%s,%s)"
for i in range(0,7):
    val=(i, y['daily']['data'][i]['time'],y['daily']['data'][i]['temperatureMax'], y['daily']['data'][i]['humidity'], y['daily']['data'][i]['pressure'], y['daily']['data'][i]['windSpeed'], y['daily']['data'][i]['summary'])
    cursor.execute(sql,val)
    print("done", i)
mysql_connection.commit()
