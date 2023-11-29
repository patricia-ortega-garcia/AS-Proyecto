import matplotlib.pyplot as plt
import pandas as pd
from io import BytesIO
import mysql.connector

# Configuración de la conexión a la base de datos
db_config = {
    'host': 'db',
    'user': 'root',
    'password': 'example',
    'database': 'database'
}

# Establecer conexión a la base de datos
conn = mysql.connector.connect(db_config)

# Consulta SQL para obtener los datos
sql_query = "SELECT * FROM mytable"

# Obtener datos de la base de datos en un DataFrame
df = pd.read_sql(sql_query, conn)

# Cerrar la conexión a la base de datos
conn.close()

# Dividir los géneros y contar la frecuencia de cada uno
genres = df['Genre'].str.split(', ', expand=True).stack().value_counts()

# Crear un gráfico de barras
plt.figure(figsize=(10, 6))
genres.plot(kind='bar', color='skyblue')
plt.title('Frecuencia de Juegos por Género')
plt.xlabel('Género')
plt.ylabel('Número de Juegos')

# Guardar el gráfico en una imagen
image_stream = BytesIO()
plt.savefig(image_stream, format='png')
image_stream.seek(0)

# Puedes guardar la imagen en un archivo si lo deseas
plt.savefig('./imagenes/frecuencia_generos.png', format='png')

# Puedes mostrar el gráfico si estás ejecutando el script en un entorno interactivo
# plt.show()

# Cerrar la figura para liberar recursos
plt.close()

# Ahora, image_stream contiene la imagen en formato bytes
# Puedes usar image_stream para mostrar la imagen en una aplicación web o guardarlo en una base de datos, etc.
