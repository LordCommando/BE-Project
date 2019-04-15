from random import seed
from random import randint

csvData = []
temp=[]

seed(1)
for _ in range(0,1800):
    value1=randint(15,40)
    value2=randint(2,25)
    if 15 <= value1 <= 40 and 2 <= value2 <=25:
        value3=1
    else:
        value3=0
    temp=[value1,value2,value3]
    print(*temp,sep=',')
    
