# 🚀 Despliegue del Proyecto con Docker y Laravel

## 1️⃣ Instalar dependencias del proyecto
```sh
npm install
```
Este comando instala todas las dependencias de `package.json` necesarias para el frontend.

---

## 2️⃣ Generar la build del frontend
```sh
npm run build
```
Crea una versión optimizada del frontend lista para producción.

---

## 3️⃣ Construir y levantar los contenedores con Docker
```sh
docker-compose up -d --build
```
- `-d`: Ejecuta los contenedores en segundo plano.
- `--build`: Fuerza la reconstrucción de las imágenes.

---

## 4️⃣ Otorgar permisos adecuados a los directorios requeridos
```sh
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
```
🔹 Cambia el propietario de los directorios a `www-data` (usuario del servidor web).  
🔹 Asigna permisos `775` para garantizar que el servidor pueda escribir en ellos.

---

## 5️⃣ Ejecutar migraciones 
```sh
docker-compose exec app php artisan migrate --seed --class=UserBrokerDataSeeder
```
- `migrate`: Aplica las migraciones a la base de datos.


## 6️⃣ Ejecutar migraciones y seeders (primero se debe crear usuario)
```sh
docker-compose exec app php artisan db:seed --class=UserBrokerDataSeeder
```
- `seed`: Rellena la base de datos con datos de prueba.
- `--class=UserBrokerDataSeeder`: Ejecuta un seeder específico.
php artisan db:seed --class=UserBrokerDataSeeder


---

📌 **¡Listo!** Ahora el proyecto está desplegado y funcionando correctamente. 🚀
