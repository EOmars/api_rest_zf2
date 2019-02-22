# api_rest_zf2
prueba de api rest con zf2 y doctrine


#1. POST calificaciones
###/calificacion

###Parámetros: 
```
calificacion : float
alumno : int
materia : int
```

Ejemplo: 
```
curl -XPOST -H "Content-Type: application/json"   -d'{"calificacion":10,"alumno":1,"materia":1}' http://mi-dominio/calificacion
```