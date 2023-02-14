# PruebaBack
 
para el consumo de las api 

obtener todos los tickets creados

GET http://localhost/PruebaBack/ticket

obtener un ticket en especifico

GET http://localhost/PruebaBack/ticket/:id

crear un ticket 
POST http://localhost/PruebaBack/ticket user="Sebastian" descripcion="testCreacion"

actualizar un ticket
PATCH http://localhost/PruebaBack/ticket estatus='0'

eliminar un ticket

DELETE http://localhost/PruebaBack/ticket/1
