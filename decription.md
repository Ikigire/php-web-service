<-- Endpoint para tareas -->
GET     -> http://www.myapi.com/api/v-1/tareas  (Obtener todas las tareas)
GET     -> http://www.myapi.com/api/v-1/tareas/byid/{id}    (Obtener una tarea por su id)
GET     -> http://www.myapi.com/api/v-1/tareas/byuser/{idUser}  (Obtener las tareas registradas por el usuario con cierto id)
POST    -> http://www.myapi.com/api/v-1/tareas
PUT     -> http://www.myapi.com/api/v-1/tareas/{id}
DELETE  -> http://www.myapi.com/api/v-1/tareas/{id}

<-- Endpoints para usuarios -->
GET     -> http://www.myapi.com/api/v-1/usuarios        Obtener todos los usuario (Query Params) - [fields (Campos de la tabla a consultar), searchby (campo por el cual se efectuara algún filtro)]

GET     -> http://www.myapi.com/api/v-1/usuarios/{id}   Obtener un usuario por su ID

POST    -> http://www.myapi.com/api/v-1/usuarios        (Body) - Objeto usuario para registrar

PUT     -> http://www.myapi.com/api/v-1/usuarios/{id}

DELETE  -> http://www.myapi.com/api/v-1/usuarios/{id} 


<-- Endpoint para <endpoint> -->
http://www.myapi.com/api/v-1/<enpoint>