# instalar paquetes
npm install 

# Crear build
npm run build

# Construir los contenedores
docker-compose up -d --build

# Otorgar permisos al usuario del contenedor
docker-compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Asignar permisos de escritura
docker-compose exec app chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Correr migraciones
docker-compose exec app php artisan migrate


------------------------------------------------------


# sensores y datos con seeder

docker-compose exec app php artisan db:seed --class=UserBrokerDataSeeder





