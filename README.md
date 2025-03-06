🚀 Despliegue del Proyecto con Docker y Laravel
1️⃣ Instalar dependencias del proyecto

npm install

Este comando instala todas las dependencias de package.json necesarias para el frontend.
2️⃣ Generar la build del frontend

npm run build

Crea una versión optimizada del frontend lista para producción.
3️⃣ Construir y levantar los contenedores con Docker

docker-compose up -d --build

    -d: Ejecuta los contenedores en segundo plano.
    --build: Fuerza la reconstrucción de las imágenes.

4️⃣ Otorgar permisos adecuados a los directorios requeridos

PERMISSIONS_PATHS=(
    "/var/www/storage"
    "/var/www/bootstrap/cache"
)

docker-compose exec app bash -c "\
    for path in \"${PERMISSIONS_PATHS[@]}\"; do
        chown -R www-data:www-data \$path
        chmod -R 775 \$path
    done
"

🔹 Cambia el propietario de los directorios a www-data (usuario del servidor web).
🔹 Asigna permisos 775 para garantizar que el servidor pueda escribir en ellos.
5️⃣ Ejecutar migraciones y seeders

docker-compose exec app php artisan migrate --seed --class=UserBrokerDataSeeder

    migrate: Aplica las migraciones a la base de datos.
    --seed: Rellena la base de datos con datos de prueba.
    --class=UserBrokerDataSeeder: Ejecuta un seeder específico.

