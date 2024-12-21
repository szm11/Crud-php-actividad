# Requisitos del Proyecto

- Tener Git instalado
- Tener Docker instalado

# Pasos para la Instalación

- Clonar el repositorio
- Configurar el archivo .env basado en .env.example
- Ejecutar `docker-compose up -d --build`
- Ejecutar `docker-compose exec app composer install`
- Ejecutar `docker-compose exec app composer dump-autoload`

# Si es necesario migrar la base de datos

- Ejecutar `docker-compose exec app php crud migrate`