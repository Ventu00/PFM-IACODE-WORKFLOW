# Proyecto base — Laboratorio del PFM

Esqueleto de partida para el laboratorio experimental del PFM *"Integración
segura de herramientas de IA Generativa en el desarrollo de aplicaciones
web"*. **Este proyecto está intencionadamente vacío de lógica de negocio**:
los 4 módulos (autenticación, formulario de datos, subida de archivos,
búsqueda con filtros) los tienes que generar tú con ChatGPT, usando los
prompts del capítulo 3, para que el experimento sea válido.

## 1. Instalación

Este esqueleto no incluye `vendor/` ni `composer.lock` (dependencias de
PHP), porque se generan al instalar. En tu máquina, con PHP y Composer
instalados:

```bash
composer install
cp .env.example .env      # si no lo ha hecho composer ya
php artisan key:generate
```

### Opción recomendada: Docker con Laravel Sail

Si no quieres instalar PHP/MySQL en tu máquina, usa Sail (ya está en
`composer.json` como dependencia de desarrollo y el `docker-compose.yml`
ya viene preparado):

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

La app quedará disponible en `http://localhost`.

## 2. Cómo se usa este proyecto para el experimento (recordatorio del capítulo 3-4)

Los **8 prompts listos para copiar y pegar en ChatGPT** (básico + seguridad
para cada uno de los 4 módulos) están en **[`PROMPTS.md`](./PROMPTS.md)**.
No hace falta escribir nada, solo copiar, pegar en una conversación nueva
de ChatGPT, y seguir estos pasos:

1. Copia un prompt de `PROMPTS.md` y pégalo en ChatGPT.
2. Pega el código que te devuelva en una rama nueva, por ejemplo:
   `git checkout -b auth-basico-sin-corregir`
3. Ejecuta el pipeline (Semgrep, Composer Audit, SonarQube, Gitleaks,
   OWASP ZAP) y anota los resultados en la hoja de cálculo
   `PFM_Hoja_Resultados_Laboratorio.xlsx`.
4. Corrige lo que haya encontrado el pipeline, vuelve a ejecutarlo, y
   guarda esa versión corregida en otra rama: `auth-basico-corregido`.
5. Repite los pasos 1-4 con el **prompt de seguridad** del mismo módulo,
   en dos ramas nuevas: `auth-seguridad-sin-corregir` y
   `auth-seguridad-corregido`.
6. Repite todo el proceso para los otros 3 módulos.

Al terminar tendrás 16 ramas (4 módulos × 4 versiones) y la hoja de
resultados rellena — la base para el capítulo 5.

## 3. Datos de prueba

Antes de ejecutar OWASP ZAP sobre un módulo, recuerda rellenar
`database/seeders/DatabaseSeeder.php` con datos fijos (mismo usuario de
prueba, mismos registros) para que las 16 versiones se prueben en las
mismas condiciones. Instrucciones dentro del propio archivo.

## 4. Herramientas del pipeline (instalación rápida, capítulo 4.3)

| Herramienta | Instalación |
|---|---|
| Semgrep | `pip install semgrep` (o Docker: `returntocorp/semgrep`) |
| Composer Audit | ya incluido en Composer: `composer audit` |
| SonarQube Community | contenedor Docker: `docker run -d -p 9000:9000 sonarqube:community` |
| Gitleaks | `brew install gitleaks` / binario desde GitHub Releases |
| OWASP ZAP | `docker run -t owasp/zap2docker-stable zap-baseline.py -t http://host.docker.internal` |

## 5. Estructura

```
routes/web.php                     — rutas (con TODOs por módulo)
resources/views/layouts/app.blade.php — layout base
resources/views/welcome.blade.php  — página de inicio
database/seeders/DatabaseSeeder.php — datos de prueba (a rellenar)
docker-compose.yml                 — entorno Sail (PHP + MySQL)
.env.example                       — configuración de entorno
```
