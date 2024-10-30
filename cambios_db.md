Nombre 'tranfer_hotel' a 'transfer_hotel'

Cambiado transfer_hotel.password a nullable, porque no se usa en este producto.

Cambiado transfer_zona.descripcion a varchar(300)

Agregada una zona que se usara por defecto en el producto.

Agregado un vehiculo que se usara por defecto en el producto

Cambiado transfer_tipo_reserva.descripcion a varchar(50)

Agregados los tres tipos de reserva; aeropuerto-hotel, hotel-aeropuerto, ida-y-vuelta

Cambiado transfer_hotel.usuario a varchar(30)

Agregado hotel por defecto

Cambiado transfer_precios.precio a float

Cambiado transfer_precios.id_precios a columna autogenerada y llave principal

Agregado precio por defecto

Cambiado transfer_reservas.email_cliente a varchar(50)
