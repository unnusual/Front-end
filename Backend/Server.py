from flask import Flask, render_template
import mysql.connector

app = Flask(__name__)

def get_db_connection():
    connection = mysql.connector.connect(
        host='localhost',       
        user='ProyectoSC24',      
        password='7eYH8aJ2x=T1!9US', 
        database='universidad' 
    )
    return connection

@app.route('/')
def index():
    connection = get_db_connection()
    cursor = connection.cursor(dictionary=True)
    cursor.execute('SELECT * FROM base_datos_sistemas_colab')  
    usuarios = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template('index.html', usuarios=usuarios)

if __name__ == '__main__':
    app.run(debug=True)
