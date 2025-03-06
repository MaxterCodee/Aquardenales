# Instalar paquetes
npm install

# Crear build
npm run build

# Construir y levantar los contenedores
docker-compose up -d --build

# Otorgar permisos adecuados al contenedor
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

# Ejecutar migraciones y seeders
docker-compose exec app php artisan migrate --seed --class=UserBrokerDataSeeder
