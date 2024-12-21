# requisitos para el proyecto

- tener instlado git
- tener instalado docker 

# pasos para la instalacion

- Clonar el repositorio
- configurar .env basado en .env.example 
- correr `docker-compose up -d --build`
- correr `docker-compose exec app composer install`
- correr `docker-compose exec app composer dump-autoload`
dump-autoload
# si necesita migrar la base de datos

- ejecutar `docker-compose exec app php lego migrate`