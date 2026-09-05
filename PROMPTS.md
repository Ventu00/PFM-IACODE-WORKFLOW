# Prompts para ChatGPT — Laboratorio del PFM

Copia y pega cada prompt **tal cual** en ChatGPT (una conversación nueva por
prompt, para no arrastrar contexto de un módulo a otro). Todos incluyen ya
el contexto del proyecto, así que no hace falta que añadas nada más.

Cuando ChatGPT te devuelva el código, guárdalo en la rama correspondiente
(ver README, sección 2) antes de pasar al siguiente prompt.

---

## Módulo 1 — Autenticación

### Prompt básico
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos.

Genera un módulo completo de registro e inicio de sesión de usuario, con
los campos: nombre, correo electrónico y contraseña.

Incluye: migración de la tabla necesaria, modelo, controlador, rutas y
vistas Blade con los formularios de registro y login.
```

### Prompt orientado a seguridad
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos.

Genera un módulo completo de registro e inicio de sesión de usuario, con
los campos: nombre, correo electrónico y contraseña.

Incluye: migración de la tabla necesaria, modelo, controlador, rutas y
vistas Blade con los formularios de registro y login.

Ten en cuenta los siguientes requisitos de seguridad:
- Valida y sanea todas las entradas del usuario.
- Cifra la contraseña de forma segura.
- Protege los formularios frente a CSRF.
- Limita el número de intentos de inicio de sesión para evitar fuerza bruta.
- Los mensajes de error no deben revelar si un correo electrónico ya existe
  en el sistema o no.
```

---

## Módulo 2 — Formulario de datos (perfil de usuario)

### Prompt básico
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para que un usuario autenticado pueda editar su
perfil: nombre, correo electrónico y una biografía corta (texto libre).

Incluye: migración (para añadir el campo de biografía si hace falta),
controlador, ruta y vista Blade con el formulario de edición.
```

### Prompt orientado a seguridad
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para que un usuario autenticado pueda editar su
perfil: nombre, correo electrónico y una biografía corta (texto libre).

Incluye: migración (para añadir el campo de biografía si hace falta),
controlador, ruta y vista Blade con el formulario de edición.

Ten en cuenta los siguientes requisitos de seguridad:
- Valida y sanea todas las entradas, especialmente el campo de biografía
  al ser texto libre.
- Evita que el contenido introducido por el usuario pueda ejecutar código
  en el navegador de otros usuarios (XSS) al mostrarse.
- Protege el formulario frente a CSRF.
```

---

## Módulo 3 — Subida de archivos

### Prompt básico
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para que un usuario autenticado pueda subir un
archivo adjunto y asociarlo a su perfil.

Incluye: migración de la tabla necesaria para guardar la referencia del
archivo, controlador, ruta y vista Blade con el formulario de subida.
```

### Prompt orientado a seguridad
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para que un usuario autenticado pueda subir un
archivo adjunto y asociarlo a su perfil.

Incluye: migración de la tabla necesaria para guardar la referencia del
archivo, controlador, ruta y vista Blade con el formulario de subida.

Ten en cuenta los siguientes requisitos de seguridad:
- Restringe los tipos de archivo permitidos (por ejemplo, solo imágenes o
  PDF) y el tamaño máximo.
- Renombra el archivo de forma segura al guardarlo (no uses el nombre
  original tal cual).
- Guarda el archivo fuera de cualquier carpeta directamente accesible
  desde el navegador.
- Evita cualquier posibilidad de que el usuario pueda acceder a rutas del
  servidor fuera de la carpeta de subidas (path traversal).
```

---

## Módulo 4 — Búsqueda con filtros

### Prompt básico
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para listar y buscar "productos" (con campos
nombre y categoría) filtrando por nombre y por categoría.

Incluye: migración de la tabla de productos, modelo, controlador, ruta y
vista Blade con el formulario de búsqueda y el listado de resultados.
```

### Prompt orientado a seguridad
```
Estoy desarrollando una aplicación web en Laravel 11, usando Eloquent,
migraciones y vistas Blade, con MySQL como base de datos. Ya existe un
módulo de autenticación de usuarios.

Genera un módulo completo para listar y buscar "productos" (con campos
nombre y categoría) filtrando por nombre y por categoría.

Incluye: migración de la tabla de productos, modelo, controlador, ruta y
vista Blade con el formulario de búsqueda y el listado de resultados.

Ten en cuenta los siguientes requisitos de seguridad:
- Usa siempre Eloquent o consultas parametrizadas; nunca concatenes
  directamente los filtros de búsqueda en una consulta SQL.
- Asegúrate de que un usuario solo pueda ver o modificar los datos que le
  corresponden, evitando que pueda acceder a registros de otros usuarios
  cambiando un identificador en la URL (IDOR).
```

---

## Después de cada prompt

1. Guarda el código en su rama (`git checkout -b <modulo>-<basico|seguridad>-sin-corregir`).
2. Ejecuta el pipeline (Semgrep, Composer Audit, SonarQube, Gitleaks, OWASP ZAP).
3. Anota los resultados en `PFM_Hoja_Resultados_Laboratorio.xlsx`.
4. Corrige lo que haya encontrado el pipeline, vuelve a ejecutarlo, y
   guarda esa versión en la rama `..._corregido`.
