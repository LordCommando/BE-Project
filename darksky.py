import requests
import json
import mysql.connector as mysql
import sys



url="https://api.darksky.net/forecast/69c10ffc962bfdca265a49d656c26eb9/" + str(sys.argv[1]) + ',' + str(sys.argv[2])
print(url)
response = requests.get(url)
jsongeocode = response.text
y=json.loads(jsongeocode)

mysql_connection = mysql.connect(user='root', password='', database='darktest')
cursor = mysql_connection.cursor()

sql= "INSERT into weather(temp, humidity, pressure, wind, summary) values (%s,%s,%s,%s,%s)"

val=(y['currently']['temperature'], y['currently']['humidity'], y['currently']['pressure'], y['currently']['windSpeed'], y['currently']['summary'])
cursor.execute(sql,val)
mysql_connection.commit()
print("done")