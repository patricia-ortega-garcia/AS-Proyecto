import pandas as pd
import matplotlib.pyplot as plt
from io import BytesIO

# Lee el archivo CSV
df = pd.read_csv('juegosParaGraficoCOMPLETO.csv')

# Cuenta la frecuencia de juegos por género
genre_counts = df['Genre'].value_counts()

# Selecciona los 5 géneros más frecuentes
top_genres = genre_counts.head(5)

# Configura el gráfico de barras
plt.figure(figsize=(10, 6))
top_genres.plot(kind='bar', color='skyblue')
plt.title('Frecuencia de Juegos por Género')
plt.xlabel('Género')
plt.ylabel('Número de Juegos')
plt.xticks(rotation=45, ha='right')  # Rota las etiquetas del eje x para mayor legibilidad
plt.tight_layout()

# Guardar el gráfico en una imagen
image_stream = BytesIO()
plt.savefig(image_stream, format='png')
image_stream.seek(0)

# Puedes guardar la imagen en un archivo si lo deseas
plt.savefig('./imagenes/frecuencia_generos.png', format='png')

# Cerrar la figura para liberar recursos
plt.close()