<?php

use yii\db\Migration;

/**
 * Class m171202_111329_datos_iniciales
 */
class m171202_111329_datos_iniciales extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->batchInsert('user_type', ['user_type_name', 'user_type_value'], [
            ['Gratuito', 10], ['Suscrito', 20]
        ]);

        $this->batchInsert('status', ['status_name', 'status_value'], [
            ['Activo', 10], ['Inactivo', 5], ['Pendiente', 4], ['Bloqueado', 0]
        ]);

        $this->batchInsert('roles', ['rol_name', 'rol_value'], [
            ['user', 10], ['admin', 25], ['superAdmin', 30], ['proveedor', 20]
        ]);

        // Inserta el usuario Admin y usuarios de control

        $this->batchInsert('user', ['username', 'email', 'rol_id', 'user_type_id', 'status_id', 'password_hash', 'auth_key', 'proveedor'], [
            ['SuperAdmin', 'sa@gmail.com', 30, 20, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), false
            ],
            ['Administrador', 'admin@gmail.com', 25, 20, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), false
            ],
            ['InvitadoActivo', 'invitadoActivo@gmail.com', 10, 10, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), false
            ],
            ['Proveedor1', 'proveedor1@gmail.com', 20, 20, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), true
            ],
            ['Proveedor2', 'proveedor2@gmail.com', 20, 20, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), true
            ],
            ['Inactivo', ', invitadoInactivo@gmail.com', 10, 10, 5,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), false
            ],
            ['ProveedorAdmin', 'proveedor3@gmail.com', 25, 20, 10,
                Yii::$app->security->generatePasswordHash('123456'),
                Yii::$app->security->generateRandomString(), true
            ],
        ]);

        $this->batchInsert('gender', ['gender_name'], [
            ['Hombre'], ['Mujer'], /* ['Trans'], ['Gay'], ['Lesbiana'], ['Bisexual'], ['Intersexual'],*/
        ]);

        $this->batchInsert('profile', ['user_id', 'nombre', 'apellidos', 'gender_id', 'created_at', 'updated_at'], [
            [1, 'Juan', 'Lorenzo Jiménez', 1, '2017-10-10', '2017-10-10'],
            [2, 'María', 'Lorenzo Jiménez', 2, '2017-10-10', '2017-10-10'],
            [3, 'Luis', 'Lorenzo Jiménez', 1, '2017-10-10', '2017-10-10'],
            [4, 'Isabel', 'Lorenzo Jiménez', 2, '2017-10-10', '2017-10-10'],
            [5, 'Manuel', 'Lorenzo Jiménez', 1, '2017-10-10', '2017-10-10'],
            [6, 'María Regla', 'Lorenzo Jiménez', 2, '2017-10-10', '2017-10-10'],
        ]);

        $this->batchInsert('imagen_profile', ['profile_id', 'url'], [
            [1, 'imagenes/imgAva/user-9.png'],
            [2, 'imagenes/imgAva/user-2.png'],
            [3, 'imagenes/imgAva/user-3.png'],
            [4, 'imagenes/imgAva/user-5.png'],
            [5, 'imagenes/imgAva/user-7.png'],
            [6, 'imagenes/imgAva/user-10.png'],
        ]);

        $this->batchInsert('tipos_iva', ['descripcion_iva', 'porcentaje_iva'], [
            ['Superreducido', 4], ['Reducido', 10], ['General', 21]
        ]);

        $this->batchInsert('unidades_tiempo', ['plural', 'singular'], [
            ['Hours', 'Hour'], ['Days', 'Day'], ['Weeks', 'Week'], ['Months', 'Month'], ['Years', 'Year'],
        ]);

        $this->batchInsert('servicios', ['descripcion', 'precio', 'proveedor_id', 'duracion', 'duracion_unidad_id', 'puntuacion', 'num_votos', 'media_punt'], [
            ['Vuelta en Barco por la Desembocadura del Guadalquivir', 15, 4, 6, 1, 128, 32, 4],
            ['Paseo en bicicleta por la Vía Verde', 10, 5, 2, 1, 95, 25, 3.8],
            ['Aprende a tocar la guitarra', 60, 4, 10, 2, 65, 26, 2.5],
            ['Cena romántica a pie de corral de pesca', 75, 4, 10, 2, 65, 26, 2.5],
            ['Subida al faro de Chipiona', 30, 7, 10, 2, 65, 26, 2.5],
            ['Clases de tenis', 12, 4, 10, 2, 65, 26, 2.5],
            ['Museo del Moscatel', 6, 5, 10, 2, 65, 26, 2.5],
            ['Visita al CINLAC', 14, 7, 10, 2, 65, 26, 2.5],
            ['Almuerzo Chiringuito Las Delicias', 19, 4, 10, 2, 65, 26, 2.5],
            ['Visita Isla Salmedina y Barco del Arroz', 45, 5, 10, 2, 65, 26, 2.5],
            ['Museo del Santuario de Regla', 33, 5, 10, 2, 65, 26, 2.5],
            ['Exposición Nuevo Mundo', 22, 7, 10, 2, 65, 26, 2.5],
        ]);

        $this->batchInsert('imagen_servicio', ['servicio_id', 'url', 'urlthumb'], [
            [1, 'imagenes/imgServ/paseoBarca1.jpg', 'imagenes/thumbs/paseoBarca1-thumb.jpg'],
            [1, 'imagenes/imgServ/paseoBarca2.jpg', 'imagenes/thumbs/paseoBarca2-thumb.jpg'],
            [1, 'imagenes/imgServ/paseoBarca3.jpg', 'imagenes/thumbs/paseoBarca3-thumb.jpg'],
            [2, 'imagenes/imgServ/bicicleta1.jpg', 'imagenes/thumbs/bicicleta1-thumb.jpg'],
            [2, 'imagenes/imgServ/bicicleta2.jpg', 'imagenes/thumbs/bicicleta2-thumb.jpg'],
            [2, 'imagenes/imgServ/bicicleta3.jpg', 'imagenes/thumbs/bicicleta3-thumb.jpg'],
            [2, 'imagenes/imgServ/bicicleta4.jpg', 'imagenes/thumbs/bicicleta4-thumb.jpg'],
            [3, 'imagenes/imgServ/guitarra1.jpg', 'imagenes/thumbs/guitarra1-thumb.jpg'],
            [3, 'imagenes/imgServ/guitarra2.jpg', 'imagenes/thumbs/guitarra2-thumb.jpg'],
            [3, 'imagenes/imgServ/guitarra3.jpg', 'imagenes/thumbs/guitarra3-thumb.jpg'],
            [4, 'imagenes/imgServ/cenacorral1.jpg', 'imagenes/thumbs/cenacorral1-thumb.jpg'],
            [4, 'imagenes/imgServ/cenacorral2.jpg', 'imagenes/thumbs/cenacorral2-thumb.jpg'],
            [4, 'imagenes/imgServ/cenacorral3.jpg', 'imagenes/thumbs/cenacorral3-thumb.jpg'],
            [5, 'imagenes/imgServ/faro1.png', 'imagenes/thumbs/faro1-thumb.png'],
            [5, 'imagenes/imgServ/faro2.jpg', 'imagenes/thumbs/faro2-thumb.jpg'],
            [5, 'imagenes/imgServ/faro3.jpg', 'imagenes/thumbs/faro3-thumb.jpg'],
            [6, 'imagenes/imgServ/tenis1.jpg', 'imagenes/thumbs/tenis1-thumb.jpg'],
            [6, 'imagenes/imgServ/tenis2.jpg', 'imagenes/thumbs/tenis2-thumb.jpg'],
            [6, 'imagenes/imgServ/tenis3.jpg', 'imagenes/thumbs/tenis3-thumb.jpg'],
            [6, 'imagenes/imgServ/tenis4.jpg', 'imagenes/thumbs/tenis4-thumb.jpg'],
            [7, 'imagenes/imgServ/marcielo.jpg', 'imagenes/thumbs/marcielo-thumb.jpg'],
            [7, 'imagenes/imgServ/fondomar.jpg', 'imagenes/thumbs/fondomar-thumb.jpg'],
            [7, 'imagenes/imgServ/abstracta.jpg', 'imagenes/thumbs/abstracta-thumb.jpg'],
            [7, 'imagenes/imgServ/bosque.jpg', 'imagenes/thumbs/bosque-thumb.jpg'],
            [8, 'imagenes/imgServ/bosquemontaña.jpg', 'imagenes/thumbs/bosquemontaña-thumb.jpg'],
            [8, 'imagenes/imgServ/hoja.jpg', 'imagenes/thumbs/hoja-thumb.jpg'],
            [8, 'imagenes/imgServ/gaviota.jpg', 'imagenes/thumbs/gaviota-thumb.jpg'],
            [9, 'imagenes/imgServ/lago2.jpg', 'imagenes/thumbs/lago2-thumb.jpg'],
            [9, 'imagenes/imgServ/dienteleon.jpg', 'imagenes/thumbs/dienteleon-thumb.jpg'],
            [9, 'imagenes/imgServ/rocas.jpg', 'imagenes/thumbs/rocas-thumb.jpg'],
            [10, 'imagenes/imgServ/lagoInvierno.jpg', 'imagenes/thumbs/lagoInvierno-thumb.jpg'],
            [10, 'imagenes/imgServ/lagoHelado.jpg', 'imagenes/thumbs/lagoHelado-thumb.jpg'],
            [10, 'imagenes/imgServ/lago.jpg', 'imagenes/thumbs/lago-thumb.jpg'],
            [10, 'imagenes/imgServ/playa.jpg', 'imagenes/thumbs/trigal-thumb.jpg'],
            [10, 'imagenes/imgServ/trigoseco.jpg', 'imagenes/thumbs/trigoseco-thumb.jpg'],
            [11, 'imagenes/imgServ/trigalverde.jpg', 'imagenes/thumbs/trigalverde-thumb.jpg'],
            [11, 'imagenes/imgServ/tractor.jpg', 'imagenes/thumbs/tractor-thumb.jpg'],
            [11, 'imagenes/imgServ/fondowindows.jpg', 'imagenes/thumbs/fondowindows-thumb.jpg'],
            [12, 'imagenes/imgServ/sunset.jpg', 'imagenes/thumbs/sunset-thumb.jpg'],
            [12, 'imagenes/imgServ/mago.jpg', 'imagenes/thumbs/mago-thumb.jpg'],
            [12, 'imagenes/imgServ/catarata.jpg', 'imagenes/thumbs/catarata-thumb.jpg'],
        ]);

        $this->batchInsert('estado_ventas',  ['estado'], [
            ['En curso'], ['Pendiente Pago'], ['Borrador'], ['Finalizada']
        ]);

    }

    public function down()
    {
        $this->delete('lineas_venta');
        $this->delete('ventas');
        $this->delete('estado_ventas');
        $this->delete('servicios_categorias');
        $this->delete('categorias');
        $this->delete('servicios_etiquetas');
        $this->delete('etiquetas');
        $this->delete('imagen_servicio');
        $this->delete('votaciones');
        $this->delete('comentarios');
        $this->delete('servicios');
        $this->delete('unidades_tiempo');
        $this->delete('tipos_iva');
        $this->delete('imagen_profile');
        $this->delete('profile');
        $this->delete('gender');
        $this->delete('user');
        $this->delete('roles');
        $this->delete('status');
        $this->delete('user_type');
    }
}
