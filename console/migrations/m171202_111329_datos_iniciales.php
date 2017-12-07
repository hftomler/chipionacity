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

        $this->batchInsert('servicios', ['descripcion', 'descripcion_lg', 'precio', 'proveedor_id', 'duracion', 'duracion_unidad_id', 'puntuacion', 'num_votos', 'media_punt', 'created_at', 'updated_at', 'promocion'], [
            ['Paseo en Barco por la Desembocadura del Guadalquivir', 'Pasa un día estupendo con un paseo por las plácidas aguas del Guadalquivir. Incluye Amuerzo-Picnic en la Playa de Doñana', 15, 4, 6, 1, 128, 32, 4, '2017-09-15', '2017-09-15', false],
            ['Paseo en bicicleta por la Vía Verde', 'La vía verde Entre Ríos discurre por la antigua vía del tren, entre las localidades del Pto. de Santa Mª. hasta Sanlúcar, pasando por Rota y Chipiona.',10, 5, 2, 1, 95, 25, 3.8, '2017-09-18', '2017-09-18', false],
            ['Aprende a tocar la guitarra', 'Aprende en una semana a acompañar tus propias canciones de la mano de un Licenciado en Guitarra Flamenca.', 60, 4, 10, 2, 65, 26, 2.5, '2017-09-22', '2017-09-22', true],
            ['Cena romántica a pie de corral de pesca', 'Los corrales de pesca a pie son un monumento artificial que se remonta a la época de los fenicios. Ahora puedes cenar prácticamente a su orilla.', 75, 4, 10, 2, 50, 12, 2.5, '2017-08-10', '2017-06-04', false],
            ['Subida al faro de Chipiona', 'El Faro de Chipiona es el más alto de España y el 5º de Europa. Desde su mirador se puede disfrutar de las mejores vistas de la Desembocadura del Guadalquivir.', 30, 7, 10, 2, 42, 41, 2.5, '2017-06-04', '2017-08-10', false],
            ['Clases de tenis', 'Aprovecha este verano y aprende a jugar al tenis mientras te diviertes y haces amigos', 12, 4, 10, 2, 13, 33, 2.5, '2017-01-11', '2017-01-11', true],
            ['Museo del Moscatel', 'El moscatel de Chipiona es considerado uno de los mejores de España. Aquí te contamos su historia y el proceso de su fabricación.', 6, 5, 10, 2, 18, 11, 2.5, '2017-02-12', '2017-02-12', false],
            ['Visita al CINLAC', 'El Centro de Interpretación de la Naturaleza y el Litoral "El Camaléon" es un referente en la preservación de nuestas dunas y de una especie en peligro de extinción, el Camaleón Común', 14, 7, 10, 2, 57, 16, 2.5, '2017-05-28', '2017-05-28', false],
            ['Almuerzo Chiringuito Las Delicias', 'Disfruta de la playa de "Las Delicias" y difruta de los manjares del mar, recién traídos de la lonja', 19, 4, 10, 2, 85, 12, 2.5, '2017-09-15', '2017-09-15', true],
            ['Visita Isla Salmedina y Barco del Arroz', 'La visita a la isla semisumergida de Salmedina y el barco hundido frente a Doñana, te sumergirá en la historia de los naufragios de la desembocadura del Guadalquivir.',45, 5, 10, 2, 42, 14, 2.5, '2017-09-19', '2017-09-19', false],
            ['Museo del Santuario de Regla', 'La orden franciscana es la regente del Santuario de Regla. Con esta visita podrás entender la importancia de su misión en nuestra tierra y la historia de Ntra. Sra. de Regla.', 33, 5, 10, 2, 37, 5, 2.5, '2017-09-24',  '2017-09-24', false],
            ['Exposición Nuevo Mundo', 'Este año se conmemoran los 500 años de la I Circunnavegación y no puede ser mejor momento para disfrutar de la historia del descubrimiento, de la que fue gran testigo toda nuestra costa.', 22, 7, 10, 2, 5, 3, 2.5, '2017-11-22', '2017-11-22', false],
        ]);

        $this->batchInsert('imagen_servicio', ['servicio_id', 'descripcion', 'url', 'urlthumb'], [
            [1, 'Paseo en barca', 'imagenes/imgServ/paseoBarca1.jpg', 'imagenes/thumbs/paseoBarca1-thumb.jpg'],
            [1, 'Paseo en barca 2', 'imagenes/imgServ/paseoBarca2.jpg', 'imagenes/thumbs/paseoBarca2-thumb.jpg'],
            [1, 'Paseo en barca 3', 'imagenes/imgServ/paseoBarca3.jpg', 'imagenes/thumbs/paseoBarca3-thumb.jpg'],
            [2, 'Paseo en bicicleta', 'imagenes/imgServ/bicicleta1.jpg', 'imagenes/thumbs/bicicleta1-thumb.jpg'],
            [2, 'Por una bóveda verde', 'imagenes/imgServ/bicicleta2.jpg', 'imagenes/thumbs/bicicleta2-thumb.jpg'],
            [2, '¿Harto de bicicletas? Aquí una vista', 'imagenes/imgServ/bicicleta3.jpg', 'imagenes/thumbs/bicicleta3-thumb.jpg'],
            [2, 'Una más de pedaleo y mira que prado', 'imagenes/imgServ/bicicleta4.jpg', 'imagenes/thumbs/bicicleta4-thumb.jpg'],
            [3, 'Una guitarra', 'imagenes/imgServ/guitarra1.jpg', 'imagenes/thumbs/guitarra1-thumb.jpg'],
            [3, 'Clases de guitarra', 'imagenes/imgServ/guitarra2.jpg', 'imagenes/thumbs/guitarra2-thumb.jpg'],
            [3, 'La tercera guitarra', 'imagenes/imgServ/guitarra3.jpg', 'imagenes/thumbs/guitarra3-thumb.jpg'],
            [4, '¿Un salpicón para empezar?', 'imagenes/imgServ/cenacorral1.jpg', 'imagenes/thumbs/cenacorral1-thumb.jpg'],
            [4, 'Vista desde el chiringuito', 'imagenes/imgServ/cenacorral2.jpg', 'imagenes/thumbs/cenacorral2-thumb.jpg'],
            [4, 'La mar te arrulla mientras cae el sol', 'imagenes/imgServ/cenacorral3.jpg', 'imagenes/thumbs/cenacorral3-thumb.jpg'],
            [5, 'Faro vigilante', 'imagenes/imgServ/faro1.png', 'imagenes/thumbs/faro1-thumb.png'],
            [5, 'Desde arriba', 'imagenes/imgServ/faro2.jpg', 'imagenes/thumbs/faro2-thumb.jpg'],
            [5, 'El faro de Chipiona desde los corrales', 'imagenes/imgServ/faro3.jpg', 'imagenes/thumbs/faro3-thumb.jpg'],
            [6, 'Raqueta y pelota', 'imagenes/imgServ/tenis1.jpg', 'imagenes/thumbs/tenis1-thumb.jpg'],
            [6, 'Todas las edades', 'imagenes/imgServ/tenis2.jpg', 'imagenes/thumbs/tenis2-thumb.jpg'],
            [6, 'Diversión asegurada', 'imagenes/imgServ/tenis3.jpg', 'imagenes/thumbs/tenis3-thumb.jpg'],
            [6, 'Al final todos campeones', 'imagenes/imgServ/tenis4.jpg', 'imagenes/thumbs/tenis4-thumb.jpg'],
            [7, 'El reflejo del paraiso', 'imagenes/imgServ/marcielo.jpg', 'imagenes/thumbs/marcielo-thumb.jpg'],
            [7, 'El fondo también tiene su encanto', 'imagenes/imgServ/fondomar.jpg', 'imagenes/thumbs/fondomar-thumb.jpg'],
            [7, 'Abstracción', 'imagenes/imgServ/abstracta.jpg', 'imagenes/thumbs/abstracta-thumb.jpg'],
            [7, '¿Demasiado frío? Venta a Chipiona', 'imagenes/imgServ/bosque.jpg', 'imagenes/thumbs/bosque-thumb.jpg'],
            [8, '¿En extinción? Aquí los cuidamos para ti', 'imagenes/imgServ/camaleon1.jpg', 'imagenes/thumbs/camaleon1-thumb.jpg'],
            [8, 'Junto a dunas y pasarelas de madera', 'imagenes/imgServ/camaleon2.jpg', 'imagenes/thumbs/camaleon2-thumb.jpg'],
            [8, 'Centro de Interpretación de la Naturaleza', 'imagenes/imgServ/camaleon3.jpg', 'imagenes/thumbs/camaleon3-thumb.jpg'],
            [8, 'Colores que no creerás', 'imagenes/imgServ/hoja.jpg', 'imagenes/thumbs/hoja-thumb.jpg'],
            [8, 'Les querrás echar de comer', 'imagenes/imgServ/gaviota.jpg', 'imagenes/thumbs/gaviota-thumb.jpg'],
            [9, 'Este lago está lejos pero nos encanta', 'imagenes/imgServ/lago2.jpg', 'imagenes/thumbs/lago2-thumb.jpg'],
            [9, 'Dientes de león', 'imagenes/imgServ/dienteleon.jpg', 'imagenes/thumbs/dienteleon-thumb.jpg'],
            [9, 'La bajada de la marea nos deja éstas maravillas', 'imagenes/imgServ/rocas.jpg', 'imagenes/thumbs/rocas-thumb.jpg'],
            [10, 'Y este se quedó así porque no pudo venir', 'imagenes/imgServ/lagoInvierno.jpg', 'imagenes/thumbs/lagoInvierno-thumb.jpg'],
            [10, 'Igual de helado quedarás con nuestras experiencias', 'imagenes/imgServ/lagoHelado.jpg', 'imagenes/thumbs/lagoHelado-thumb.jpg'],
            [10, 'Así son nuestros atardeceres', 'imagenes/imgServ/playa.jpg', 'imagenes/thumbs/playa-thumb.jpg'],
            [10, 'Este lago está más lejos, pero aquí lo pongo', 'imagenes/imgServ/lago.jpg', 'imagenes/thumbs/lago-thumb.jpg'],
            [10, 'Recogiendo la cosecha', 'imagenes/imgServ/trigoseco.jpg', 'imagenes/thumbs/trigoseco-thumb.jpg'],
            [11, 'El fondo de windows', 'imagenes/imgServ/trigalverde.jpg', 'imagenes/thumbs/trigalverde-thumb.jpg'],
            [11, '¿No quieres dejar huella en el mundo? ¡Visítanos!', 'imagenes/imgServ/tractor.jpg', 'imagenes/thumbs/tractor-thumb.jpg'],
            [11, 'No te lo puedes perder', 'imagenes/imgServ/fondowindows.jpg', 'imagenes/thumbs/fondowindows-thumb.jpg'],
            [12, '¿A qué es tumblr?, que diría mi niña', 'imagenes/imgServ/sunset.jpg', 'imagenes/thumbs/sunset-thumb.jpg'],
            [12, 'Impertérrito', 'imagenes/imgServ/mago.jpg', 'imagenes/thumbs/mago-thumb.jpg'],
            [12, 'Cataratas en el río Majaceite', 'imagenes/imgServ/catarata.jpg', 'imagenes/thumbs/catarata-thumb.jpg'],
        ]);

        $this->batchInsert('etiquetas',  ['descripcion_tag'], [
            ['Deporte'], ['Fiesta'], ['Cultura'], ['Música']
        ]);

        $this->batchInsert('imagen_publi', ['etiqueta_id', 'descripcion', 'link', 'urlvt', 'urlhz'], [
            [1, 'Cross Training Global Sport', 'http://www.google.es', 'imagenes/publi/gb-cross-vt.jpg', 'imagenes/publi/gb-cross-hz.jpg'],
            [4, 'Zambomba Picoco: ', 'http://www.google.es', 'imagenes/publi/picoco-zambomba-sopa-vt.jpg', 'imagenes/publi/picoco-zambomba-sopa-hz.jpg'],
            [1, 'Clases de tenis: ', 'http://www.google.es', 'imagenes/publi/clases-tenis-vt.jpg', 'imagenes/publi/clases-tenis-hz.jpg'],
            [2, 'Trinity Irish Pub: ', 'http://www.google.es', 'imagenes/publi/trinity-vt.jpg', 'imagenes/publi/trinity-hz.jpg'],
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
