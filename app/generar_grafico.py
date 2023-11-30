import pandas as pd
import matplotlib.pyplot as plt
from io import BytesIO

# Lee el archivo CSV
df = pd.read_csv('juegosParaGraficoCOMPLETO.csv')

# Cuenta la frecuencia de juegos por género
genre_counts = df['Genre'].value_counts()

# Selecciona los 5 géneros más frecuentes
top_genres = genre_counts.head(5)

# Color RGB personalizado
color_barras = (249/255, 177/255, 122/255)
color_fondo = (66/255, 71/255, 105/255)
color_texto = (1, 1, 1)

# Configura el gráfico de barras
plt.figure(figsize=(10, 6), facecolor=color_fondo, edgecolor=color_texto)
ax = top_genres.plot(kind='bar', color=color_barras)
ax.set_facecolor(color_fondo)  # Fondo del área de las barras

plt.title('Top 5 Géneros por Frecuencia de Juego', color=color_texto)
plt.xlabel('Género', color=color_texto)
plt.ylabel('Número de Juegos', color=color_texto)
plt.xticks(rotation=45, ha='right', color=color_texto)  # Rota las etiquetas del eje x para mayor legibilidad

# Cambiar el color de los números en los ejes x e y
ax.tick_params(axis='x', colors=color_texto)  # Color de los números del eje x
ax.tick_params(axis='y', colors=color_texto)  # Color de los números del eje y

# Cambiar el color del cuadro que rodea el eje x
ax.spines['bottom'].set_color(color_texto)  # Cambia el color del cuadro del eje x
ax.spines['left'].set_color(color_texto) 
ax.spines['right'].set_color(color_texto) 
ax.spines['top'].set_color(color_texto) 

plt.tight_layout()

# Guardar el gráfico en una imagen
image_stream = BytesIO()
plt.savefig(image_stream, format='png')
image_stream.seek(0)

# Puedes guardar la imagen en un archivo si lo deseas
plt.savefig('./imagenes/frecuencia_generos.png', format='png')

# Cerrar la figura para liberar recursos
plt.close()