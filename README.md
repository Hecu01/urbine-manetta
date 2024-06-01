# Proyecto de Prácticas Profesionalizantes 3

Este proyecto ha sido desarrollado como parte de las Prácticas Profesionalizantes 3 por Valentin Urbine y Luciana Manetta.

## Descripción

El proyecto consiste en una tienda online ficticia llamada Sportivo. El objetivo es poner en práctica los conocimientos adquiridos durante el curso y desarrollar habilidades en el framework Laravel.

## Tecnologías Utilizadas

- **Framework**: Laravel 10
- **Lenguaje de Programación**: PHP 8.2+
- **Base de Datos**: MySQL
- **Frontend**: Blade Templates, HTML, CSS, JavaScript, Jquery, Bootstrap 5, TailwindCSS, SASS
- **Control de Versiones**: Git
- **Gestión de Dependencias**: Composer, NPM
- **Servidor Web**: Apache / Nginx
- **Herramientas Adicionales**: Node.js, vite

## Requisitos

- PHP >= 8.x
- Composer
- Laravel >= 10.x
- MySQL
- Node.js y NPM

## Instalación

Sigue los pasos a continuación para configurar y ejecutar el proyecto en tu máquina local.

1. Clona el repositorio:

    ```bash
    git clone https://github.com/Hecu01/urbine-manetta.git
    ```

2. Ve al directorio del proyecto:

    ```bash
    cd urbine-manetta
    ```

3. Instala las dependencias de Composer:

    ```bash
    composer install
    ```

4. Copia el archivo de configuración de ejemplo y configura el entorno:

    ```bash
    cp .env.example .env
    ```

5. Genera la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

6. Configura la base de datos en el archivo `.env`. Asegúrate de que los siguientes parámetros sean correctos:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=urbine-manetta
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. Ejecuta las migraciones de la base de datos:

    ```bash
    php artisan migrate
    ```

8. Instala las dependencias de Node.js:

    ```bash
    npm install
    ```

9. Compila los assets del frontend:

    ```bash
    npm run dev
    ```

10. Inicia el servidor de desarrollo:

    ```bash
    php artisan serve
    ```

11. Accede a la aplicación en tu navegador:

    ```
    http://127.0.0.1:8000
    ```


## Estructura del Proyecto

- `app/` - Contiene los controladores, modelos, y otros archivos del núcleo de la aplicación.
- `config/` - Archivos de configuración.
- `database/` - Migraciones y seeders de la base de datos.
- `public/` - Punto de entrada para el público.
- `resources/` - Vistas y archivos de frontend.
- `routes/` - Archivos de rutas de la aplicación.
- `tests/` - Tests unitarios y funcionales.


## Licencia

Este proyecto está licenciado bajo la Licencia MIT.


---

Este proyecto ha sido desarrollado como parte de las Prácticas Profesionalizantes 3 por Valentin Urbine y Luciana Manetta.
