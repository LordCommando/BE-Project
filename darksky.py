import requests
import json
import mysql.connector as mariadb

url="https://api.darksky.net/forecast/69c10ffc962bfdca265a49d656c26eb9/19.1644619,72.9571435"
response = requests.get(url)
jsongeocode = response.text
y=json.loads(jsongeocode)

mariadb_connection = mariadb.connect(user='root', password='', database='testdark')
cursor = mariadb_connection.cursor()

#print(y['currently']['temperature'])
sql= "INSERT into coordinates (latitude,longitude,temperature,humidity,pressure,summary) values (%s,%s,%s,%s,%s,%s)"
val=(y['longitude'],y['latitude'],y['currently']['temperature'],y['currently']['humidity'],y['currently']['pressure'],y['currently']['summary'])
cursor.execute(sql,val)
mariadb_connection.commit()
print("done")