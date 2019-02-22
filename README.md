# api_rest_zf2
prueba de api rest con zf2 y doctrine

Para cargar las bibliotecas ejecutar:
```
composer install
```

Agregar credenciales correspondientes en archivo de configuración
```
config/local.php
```

La estructura de base de datos se encuentra en 
```
data/database.sql
```

Desde el servidor web indicar como punto de entrada de ejecución:
```
public/index.php
```



# 1. POST calificaciones
### /calificacion

### Parámetros: 
```
calificacion : float
alumno : int
materia : int
```

Ejemplo: 
```
curl -XPOST -H "Content-Type: application/json"   -d'{"calificacion":10,"alumno":1,"materia":1}' http://mi-dominio/calificacion/
```

# 2. GET calificaciones de un alumno en específico

### /alumno/id

Ejemplo: 
```
curl -XGET http://mi-dominio/alumno/1
```

# 3. PUT actualizar calificaciom

### /calificacion/id

### Parámetros: 
```
calificacion : float
```
Ejemplo: 
```
curl -XPUT -H "Content-Type: application/json"   -d'{"calificacion":5}' http://mi-dominio/calificacion/1
```

# 4. DELETE Eliminar Calificacion

### /calificacion/id

Ejemplo: 
```
curl -XDELETE  http://mi-dominio/calificacion/1
```

