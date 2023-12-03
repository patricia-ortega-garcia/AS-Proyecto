import requests
from datetime import datetime

def obtener_juegos_mas_populares(api_key, num_resultados=10):
    # Obtener el año actual
    año_actual = datetime.now().year

    # URL de la API de RAWG para obtener juegos populares de este año
    url = f'https://api.rawg.io/api/games?key={api_key}&dates={año_actual}-01-01,{año_actual}-12-31&ordering=-added'

    try:
        # Realizar la solicitud GET a la API
        response = requests.get(url)
        response.raise_for_status()

        # Obtener los datos JSON de la respuesta
        datos = response.json()

        # Extraer los resultados
        resultados = datos.get('results', [])

        # Obtener los primeros 'num_resultados' juegos con el mayor conteo total de jugadores
        juegos_mas_populares = sorted(resultados, key=lambda x: x.get('added', 0), reverse=True)[:num_resultados]

        return juegos_mas_populares

    except requests.exceptions.RequestException as e:
        print(f'Error al realizar la solicitud a la API: {e}')
        return []

# Declarar la clave de API de RAWG
clave_de_api = 'a588a7b38dfb4a3db09b304bff7a946b'

# Obtener los 10 juegos más populares de este año
juegos_populares = obtener_juegos_mas_populares(clave_de_api, num_resultados=10)

# Mostrar los resultados y guardarlos en un txt
print("Los 10 juegos más populares de este año:")
archivoDatos = './mas_populares.txt'
with open(archivoDatos, 'w') as archivo:
    for i, juego in enumerate(juegos_populares, 1):
        juegoAct = f"{i}. {juego.get('name')} - Conteo total de jugadores en RAWG: {juego.get('added')}"
        print(juegoAct)
        archivo.write(juegoAct + "\n")
        #print(f"{i}. {juego.get('name')} - Conteo total de jugadores en RAWG: {juego.get('added')}")

