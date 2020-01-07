import pymysql

sql="INSERT INTO `cosmic` (`ID`, `FECHA`, `TEMPERATURA`, `TEMP_INTERNA`, `HUMEDAD`, `PRESION`, `VEL_VIENTO`, `DIR_VIENTO`, `LLUVIA`, `PM2_5`, `PM10`, `COLOR`) VALUES (NULL, CURRENT_TIMESTAMP, '25', '25.5', '33', '1010.10', '27', '48', '0', '2.5', '10', 'VOID')"
db=pymysql.connect("sustainablelab.com.mx","c132weather","powerlab1","c132estacion") 
cursor=db.cursor()
cursor.execute(sql) 
db.commit()
print("guardado db")


