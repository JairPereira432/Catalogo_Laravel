# Catalogo_Laravel

## Descripción del proyecto

Catalogo_Laravel es una aplicación web desarrollada con Laravel y Tailwind CSS que permite gestionar y visualizar un catálogo de productos de manera moderna y futurista. Incluye funcionalidades de búsqueda, visualización de detalles y una interfaz atractiva con colores rojo y negro.

## Tecnologías utilizadas

- **Laravel** (Framework PHP)
- **Tailwind CSS** (Framework de estilos)
- **JavaScript** (para interacción en el frontend)
- **MySQL** (o el motor de base de datos que configures en Laravel)
- **HTML5 y CSS3**
- **Git** y **GitHub** para control de versiones

## Pasos básicos para clonar y ejecutar el sistema

1. **Clonar el repositorio**
   ```sh
   git clone https://github.com/JairPereira432/catalogo_laravel.git
   cd catalogo_laravel
   ```

2. **Instalar dependencias de PHP y Laravel**
   ```sh
   composer install
   ```

3. **Copiar y configurar el archivo de entorno**
   ```sh
   cp .env.example .env
   ```
   Edita el archivo `.env` y configura la conexión a tu base de datos.

4. **Generar la clave de la aplicación**
   ```sh
   php artisan key:generate
   ```

5. **Ejecutar migraciones y (opcional) seeders**
   ```sh
   php artisan migrate
   # Si tienes seeders:
   # php artisan db:seed
   ```

6. **Levantar el servidor de desarrollo**
   ```sh
   php artisan serve
   ```
   Accede a [http://127.0.0.1:8000](http://127.0.0.1:8000) en tu navegador.

---

> **Nota:**  
> Si usas Node.js y tienes assets con Laravel Mix, ejecuta también:
> ```sh
> npm install
> npm run dev
> ```

---

¡Listo! Ahora tu README cumple con los requisitos de la entrega.
