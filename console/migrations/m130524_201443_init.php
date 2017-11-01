<?php
use yii\db\Migration;
use common\models\User;
class m130524_201443_init extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Creo las tablas  e inserto los valores iniciales.

        $this->createTable('paises', [
            'id'=>$this->primaryKey(),
            'nombre_pais'=>$this->string(100)->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('paises',  ['nombre_pais'], [
            ['España'], ['Alemania'], ['Francia'], ['Italia'], ['Marruecos'], ['EEUU'], ['Rusia'], ['Finlandia'], ['Bélgica']
        ]);

        $this->createTable('provincias', [
            'id'=>$this->primaryKey(),
            'nombre_provincia'=>$this->string(100)->notNull()->unique(),
            'pais_id'=>$this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_provincias_paises',
            'provincias',
            'pais_id',
            'paises',
            'id',
            'CASCADE'
        );

        $this->batchInsert('provincias', ['nombre_provincia', 'pais_id'], [
            ['Álava', 1], ['Albacete', 1], ['Alicante', 1], ['Almería', 1], ['Ávila', 1], ['Badajoz', 1], ['Islas Baleares', 1],
            ['Barcelona', 1], ['Burgos', 1], ['Cáceres', 1], ['Cádiz', 1], ['Castellón', 1], ['Ciudad Real', 1],
            ['Córdoba', 1], ['La Coruña', 1], ['Cuenca', 1], ['Girona', 1], ['Granada', 1], ['Guadalajara', 1],
            ['Guipuzcoa', 1], ['Huelva', 1], ['Huesca', 1], ['Jaén', 1], ['León', 1], ['Lérida', 1], ['La Rioja', 1],
            ['Lugo', 1], ['Madrid', 1], ['Málaga', 1], ['Murcia', 1], ['Navarra', 1], ['Ourense', 1], ['Asturias', 1],
            ['Palencia', 1], ['Las Palmas', 1], ['Pontevedra', 1], ['Salamanca', 1], ['Santa Cruz de Tenerife', 1],
            ['Cantabria', 1], ['Segovia', 1], ['Sevilla', 1], ['Soria', 1], ['Tarragona', 1], ['Teruel', 1], ['Toledo', 1],
            ['Valencia', 1],['Valladolid', 1], ['Vizcaya', 1], ['Zamora', 1], ['Zaragoza', 1], ['Ceuta', 1], ['Melilla', 1]
        ]);

        $this->batchInsert('provincias', ['nombre_provincia', 'pais_id'], [
            ['Heirom', 2], ['Alyuth', 2], ['Paris', 3], ['Lyon', 3], ['Florencia', 4], ['Berlin', 2]
        ]);


        $this->createTable('municipios', [
            'id'=>$this->primaryKey(),
            'nombre_municipio'=>$this->string(100)->notNull(),
            'provincia_id'=>$this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_municipios_provincias',
            'municipios',
            'provincia_id',
            'provincias',
            'id',
            'CASCADE'
        );

        $this->batchInsert('municipios', ['nombre_municipio', 'provincia_id'], [
            ['Alegría-Dulantzi', 1], ['Amurrio', 1], ['Aramaio', 1], ['Artziniega', 1], ['Armiñón', 1], ['Arrazua-Ubarrundia', 1], ['Asparrena', 1],
            ['Liétor', 2], ['Madrigueras', 2], ['Mahora', 2], ['Masegoso', 2], ['Minaya', 2], ['Molinicos', 2], ['Montalvos', 2], ['Montealegre del Castillo', 2],
            ['Benigembla', 3], ['Benidoleig', 3], ['Benidorm', 3], ['Benifallim', 3], ['Benifato', 3], ['Benijófar', 3],
            ['Abla', 4], ['Abrucena', 4], ['Adra', 4], ['Albánchez', 4], ['Alboloduy', 4], ['Albox', 4], ['Alcolea', 4], ['Alcóntar', 4], ['Alcudia de Monteagud', 4],
            ['Gemuño', 5], ['Gilbuena', 5], ['Gil García', 5], ['Gimialcón', 5], ['Gotarrendura', 5], ['Grandes y San Martín', 5], ['Guisando', 5], ['Gutierre-Muñoz', 5], ['Hernansancho', 5],
            ['Carmonita', 6], ['Carrascalejo, El', 6], ['Casas de Don Pedro', 6], ['Casas de Reina', 6], ['Castilblanco', 6], ['Castuera', 6], ['Codosera, La', 6],
            ['Eivissa', 7], ['Inca', 7], ['Lloret de Vistalegre', 7], ['Lloseta', 7], ['Llubí', 7], ['Llucmajor', 7], ['Maó', 7], ['Manacor', 7], ['Mancor de la Vall', 7],
            ['Papiol, El', 8], ['Parets del Vallès', 8], ['Perafita', 8], ['Piera', 8], ['Hostalets de Pierola, Els', 8], ['Pineda de Mar', 8], ['Pla del Penedès, El', 8], ['Pobla de Claramunt, La', 8],
            ['Bozoó', 9], ['Brazacorta', 9], ['Briviesca', 9], ['Bugedo', 9], ['Buniel', 9], ['Burgos', 9], ['Busto de Bureba', 9], ['Cabañes de Esgueva', 9], ['Cabezón de la Sierra', 9],
            ['Garganta la Olla', 10], ['Gargantilla', 10], ['Gargüera', 10], ['Garrovillas de Alconétar', 10], ['Garvín', 10], ['Gata', 10], ['Gordo, El', 10], ['Granja, La', 10], ['Guadalupe', 10], ['Guijo de Coria', 10],
            ['Alcalá de los Gazules', 11], ['Alcalá del Valle', 11], ['Algar', 11], ['Algeciras', 11], ['Algodonales', 11], ['Arcos de la Frontera', 11], ['Barbate', 11], ['Barrios, Los', 11], ['Benaocaz', 11],
            ['Bornos', 11], ['Bosque, El', 11], ['Cádiz', 11], ['Castellar de la Frontera', 11], ['Conil de la Frontera', 11], ['Chiclana de la Frontera', 11], ['Chipiona', 11], ['Espera', 11],
            ['Gastor, El', 11], ['Grazalema', 11], ['Jerez de la Frontera', 11], ['Jimena de la Frontera', 11], ['Línea de la Concepción, La', 11], ['Medina-Sidonia', 11], ['Olvera', 11],
            ['Paterna de Rivera', 11], ['Prado del Rey', 11], ['Puerto de Santa María, El', 11], ['Puerto Real', 11], ['Puerto Serrano', 11], ['Rota', 11], ['San Fernando', 11],
            ['Sanlúcar de Barrameda', 11], ['San Roque', 11], ['Setenil de las Bodegas', 11], ['Tarifa', 11], ['Torre Alháquime', 11], ['Trebujena', 11], ['Ubrique', 11],
            ['Vejer de la Frontera', 11], ['Villaluenga del Rosario', 11], ['Villamartín', 11], ['Zahara', 11], ['Benalup-Casas Viejas', 11], ['San José del Valle', 11],
            ['Villamalur', 12], ['Vilanova dAlcolea', 12], ['Villanueva de Viver', 12], ['Vilar de Canes', 12], ['Vila-real', 12],
            ['Picón', 13], ['Piedrabuena', 13], ['Poblete', 13], ['Porzuna', 13], ['Pozuelo de Calatrava', 13],
            ['Santaella', 14], ['Santa Eufemia', 14], ['Torrecampo', 14], ['Valenzuela', 14], ['Valsequillo', 14],
            ['Boqueixón', 15], ['Brión', 15], ['Cabana de Bergantiños', 15], ['Cabanas', 15], ['Camariñas', 15],
            ['Albaladejo del Cuende', 16], ['Albalate de las Nogueras', 16], ['Albendea', 16], ['Alberca de Záncara, La', 16], ['Alcalá de la Vega', 16],
            ['Campelles', 17], ['Campllong', 17], ['Camprodon', 17], ['Canet dAdri', 17], ['Cantallops', 17],
            ['Fuente Vaqueros', 18], ['Galera', 18], ['Gobernador', 18],
            ['Cañizar', 19], ['Cardoso de la Sierra, El', 19], ['Casa de Uceda', 19], ['Casar, El', 19], ['Casas de San Galindo', 19],
            ['Getaria', 20], ['Hernani', 20], ['Hernialde', 20], ['Ibarra', 20], ['Idiazabal', 20], ['Ikaztegieta', 20], ['Irun', 20], ['Irura', 20],
            ['Cumbres Mayores', 21], ['Chucena', 21], ['Encinasola', 21], ['Escacena del Campo', 21], ['Fuenteheridos', 21], ['Galaroza', 21],
            ['Sabiñánigo', 22], ['Sahún', 22], ['Salas Altas', 22], ['Salas Bajas', 22],
            ['Cabra del Santo Cristo', 23], ['Cambil', 23], ['Campillo de Arenas', 23], ['Canena', 23], ['Carboneros', 23], ['Carolina, La', 23],
            ['Castellar', 23], ['Castillo de Locubín', 23], ['Cazalilla', 23], ['Cazorla', 23],
            ['Torreblascopedro', 23], ['Torre del Campo', 23], ['Torredonjimeno', 23], ['Torreperogil', 23], ['Torres', 23], ['Torres de Albánchez', 23], ['Úbeda', 23],
            ['Valdepeñas de Jaén', 23], ['Vilches', 23], ['Villacarrillo', 23], ['Villanueva de la Reina', 23], ['Villanueva del Arzobispo', 23], ['Villardompardo', 23],
            ['Garrafe de Torío', 24], ['Gordaliza del Pino', 24], ['Gordoncillo', 24], ['Gradefes', 24],
            ['Albatàrrec', 25], ['Albesa', 25], ['Albi, L', 25], ['Alcanó', 25], ['Alcarràs', 25], ['Alcoletge', 25], ['Alfarràs', 25],
            ['Arnedillo', 26], ['Arnedo', 26], ['Arrúbal', 26], ['Ausejo', 26], ['Autol', 26], ['Azofra', 26], ['Badarán', 26], ['Bañares', 26], ['Baños de Rioja', 26], ['Baños de Río Tobía', 26],
            ['Berceo', 26], ['Bergasa', 26], ['Pontenova, A', 27], ['Portomarín', 27], ['Quiroga', 27], ['Ribadeo', 27],
            ['Villaviciosa de Odón', 28], ['Villavieja del Lozoya', 28], ['Zarzalejo', 28], ['Lozoyuela-Navas-Sieteiglesias', 28], ['Puentes Viejas', 28], ['Tres Cantos', 28], ['Alameda', 29],
            ['Alcaucín', 29], ['Alfarnate', 29], ['Alfarnatejo', 29], ['Algarrobo', 29], ['Algatocín', 29], ['Alhaurín de la Torre', 29], ['Alhaurín el Grande', 29],
            ['Beniel', 30], ['Blanca', 30], ['Bullas', 30], ['Calasparra', 30], ['Campos del Río', 30], ['Caravaca de la Cruz', 30], ['Cartagena', 30], ['Cehegín', 30], ['Ceutí', 30], ['Cieza', 30],
            ['Ciriza/Ziritza', 31], ['Cizur', 31], ['Corella', 31], ['Cortes', 31], ['Desojo', 31],
            ['Ribadavia', 32], ['San Xoán de Río', 32], ['Riós', 32], ['Rúa, A', 32], ['Rubiá', 32], ['San Amaro', 32], ['San Cibrao das Viñas', 32], ['San Cristovo de Cea', 32], ['Sandiás', 32], ['Sarreaus', 32],
            ['Taboadela', 32], ['Teixeira, A', 32], ['Toén', 32], ['Trasmiras', 32], ['Veiga, A', 32], ['Verea', 32], ['Verín', 32], ['Viana do Bolo', 32], ['Vilamarín', 32],
            ['Piloña', 33], ['Ponga', 33],
            ['Ampudia', 34], ['Amusco', 34], ['Antigüedad', 34], ['Arconada', 34], ['Astudillo', 34], ['Autilla del Pino', 34], ['Autillo de Campos', 34],
            ['Haría', 35], ['Ingenio', 35], ['Mogán', 35], ['Moya', 35], ['Oliva, La', 35], ['Pájara', 35],
            ['Ahigal de los Aceiteros', 37], ['Ahigal de Villarino', 37], ['Alameda de Gardón, La', 37], ['Alamedilla, La', 37],
            ['Guía de Isora', 38], ['Güímar', 38], ['Hermigua', 38], ['Icod de los Vinos', 38],
            ['Luena', 39], ['Marina de Cudeyo', 39], ['Mazcuerras', 39], ['Medio Cudeyo', 39],
            ['Chañe', 40], ['Domingo García', 40], ['Donhierro', 40], ['Duruelo', 40], ['Encinas', 40], ['Encinillas', 40], ['Escalona del Prado', 40],
            ['Dos Hermanas', 41], ['Lebrija', 41], ['Utrera', 41], ['Mairena del Aljarafe', 41], ['Alcalá de Guadaira', 41], ['Coria', 41],
            ['Castilruiz', 42], ['Castillejo de Robledo', 42], ['Centenera de Andaluz', 42], ['Cerbón', 42], ['Cidones', 42], ['Cigudosa', 42], ['Cihuela', 42],
            ['Camarles', 43], ['Aldea, L', 43], ['Salou', 43], ['Ampolla, L', 43], ['Canonja, La', 43],
            ['Rillo', 44], ['Riodeva', 44], ['Ródenas', 44], ['Royuela', 44], ['Rubiales', 44], ['Rubielos de la Cérida', 44], ['Rubielos de Mora', 44],
            ['Belvís de la Jara', 45], ['Borox', 45], ['Buenaventura', 45], ['Burguillos de Toledo', 45], ['Burujón', 45], ['Cabañas de la Sagra', 45], ['Cabañas de Yepes', 45], ['Cabezamesada', 45], ['Calera y Chozas', 45],
            ['Benisuera', 46], ['Bétera', 46], ['Bicorp', 46], ['Bocairent', 46], ['Bolbaite', 46], ['Bonrepòs i Mirambell', 46], ['Bufali', 46],
            ['Berrueces', 47], ['Bobadilla del Campo', 47], ['Bocigas', 47], ['Bocos de Duero', 47],
            ['Abanto y Ciérvana-Abanto Zierbena', 48], ['Amorebieta-Etxano', 48], ['Amoroto', 48], ['Arakaldo', 48], ['Arantzazu', 48], ['Munitibar-Arbatzegi Gerrikaitz', 48], ['Artzentales', 48], ['Arrankudiaga', 48], ['Arrieta', 48], ['Arrigorriaga', 48],
            ['Morales de Toro', 49], ['Morales de Valverde', 49], ['Moralina', 49], ['Moreruela de los Infanzones', 49],
            ['Asín', 50], ['Atea', 50], ['Ateca', 50], ['Azuara', 50], ['Badules', 50], ['Bagüés', 50], ['Balconchán', 50],
            ['Ceuta', 51], ['Melilla', 52],
        ]);

        $this->createTable('user_type', [
            'id'=> $this->primaryKey(),
            'user_type_name'=> $this->string(45)->notNull()->unique(),
            'user_type_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->insert('user_type', [
            'user_type_name' => 'Gratuito',
            'user_type_value' => '10',
        ]);

        $this->insert('user_type', [
            'user_type_name' => 'Suscrito',
            'user_type_value' => '20',
        ]);

        $this->createTable('status', [
            'id'=> $this->primaryKey(),
            'status_name'=> $this->string(45)->notNull()->unique(),
            'status_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->insert('status', [
            'status_name' => 'Activo',
            'status_value' => '10',
        ]);

        $this->insert('status', [
            'status_name' => 'Inactivo',
            'status_value' => '5',
        ]);

        $this->insert('status', [
            'status_name' => 'Pendiente',
            'status_value' => '4',
        ]);

        $this->insert('status', [
            'status_name' => 'Bloqueado',
            'status_value' => '0',
        ]);


        $this->createTable('roles', [
            'id'=> $this->primaryKey(),
            'rol_name'=> $this->string(45)->notNull()->unique(),
            'rol_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->insert('roles', [
            'rol_name' => 'user',
            'rol_value' => '10',
        ]);

        $this->insert('roles', [
            'rol_name' => 'admin',
            'rol_value' => '25',
        ]);

        $this->insert('roles', [
            'rol_name' => 'superAdmin',
            'rol_value' => '30',
        ]);

        $this->insert('roles', [
            'rol_name' => 'proveedor',
            'rol_value' => '20',
        ]);

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'rol_id'=>$this->integer()->defaultValue(10),
            'status_id' => $this->integer()->notNull()->defaultValue(10),
            'user_type_id'=>$this->integer()->defaultValue(10),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'proveedor'=>$this->boolean()->defaultValue(false),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_user_roles',
            'user',
            'rol_id',
            'roles',
            'rol_value',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_user_type',
            'user',
            'user_type_id',
            'user_type',
            'user_type_value',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_status',
            'user',
            'status_id',
            'status',
            'status_value',
            'CASCADE'
        );

        // Inserta el usuario Admin y usuarios de control

        $user = new User();
        $user->username = 'SuperAdmin';
        $user->email = 'sa@gmail.com';
        $user->rol_id = 30; // superAdmin
        $user->user_type_id = 20; // suscrito
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save() ? $user : null;

        $user = new User();
        $user->username = 'Administrador';
        $user->email = 'admin@gmail.com';
        $user->rol_id = 25; // usuario
        $user->user_type_id = 20; // gratuito
        $user->status_id = 10; // Activo (Valor defecto, pero lo pongo a tit. inform.)
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save() ? $user : null;

        $user = new User();
        $user->username = 'Proveedor1';
        $user->email = 'proveedor1@gmail.com';
        $user->rol_id = 20; // proveedor
        $user->user_type_id = 20; // suscrito
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save() ? $user : null;

        $user = new User();
        $user->username = 'InvitadoActivo';
        $user->email = 'invitadoActivo@gmail.com';
        $user->rol_id = 10; // usuario
        $user->user_type_id = 10; // gratuito
        $user->status_id = 10; // Activo (Valor defecto, pero lo pongo a tit. inform.)
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save() ? $user : null;

        $user = new User();
        $user->username = 'InvitadoInactivo';
        $user->email = 'invitadoInactivo@gmail.com';
        $user->rol_id = 10; // usuario
        $user->user_type_id = 10; // gratuito
        $user->status_id = 5; // Inactivo
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save() ? $user : null;

        $this->createTable('gender', [
            'id'=> $this->primaryKey(),
            'gender_name'=> $this->string(45)->notNull()->unique(),
        ], $tableOptions);

        $this->insert('gender', [
            'gender_name' => 'Hombre',
        ]);

        $this->insert('gender', [
            'gender_name' => 'Mujer',
        ]);
        /* ACTIVAR PARA SENSIBILIDAD LGBTI
        $this->insert('gender', [
            'gender_name' => 'Trans',
        ]);

        $this->insert('gender', [
            'gender_name' => 'Gay',
        ]);

        $this->insert('gender', [
            'gender_name' => 'Lesbiana',
        ]);

        $this->insert('gender', [
            'gender_name' => 'Bisexual',
        ]);

        $this->insert('gender', [
            'gender_name' => 'Intersexual',
        ]);
        */

        $this->createTable('profile', [
            'id'=> $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'nombre' => $this->string(255),
            'apellidos' => $this->string(255),
            'gender_id' => $this->integer(),
            'direccion' => $this->string(255),
            'pais_id'=>$this->integer(),
            'municipio_id' => $this->integer(),
            'cpostal' => $this->char(5),
            'provincia_id' => $this->integer(),
            'fecha_nac'=>$this->date(),
            'img_perfil'=>$this->string(255)->defaultValue('imagenes/imgPerfil/sinPerfil.jpg'),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            ], $tableOptions);

        $this->addForeignKey(
            'fk_profile_gender',
            'profile',
            'gender_id',
            'gender',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_profile_paises',
            'profile',
            'pais_id',
            'paises',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_profile_provincias',
            'profile',
            'provincia_id',
            'provincias',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_profile_municipios',
            'profile',
            'municipio_id',
            'municipios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_profile_user',
            'profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );


        $this->createTable('etiquetas', [
            'id'=> $this->primaryKey(),
            'descripcion_etiqueta'=> $this->string(255)->notNull(),
        ])

        $this->createTable('servicios', [
            'id'=> $this->primaryKey(),
            'categoria_id'=> $this->integer()->notNull(),
            'descripcion'=>$this->string(255)->notNull(),
            'imagen'=>$this->string(255),
            'precio'=>$this->decimal(7,2)->notNull(),
            'proveedor_id'=>$this->integer()->notNull(),
            'activo'=>$this->boolean()->defaultValue(false),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_servicios_usuarios',
            'servicios',
            'proveedor_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createTable('servicios_etiquetas', [
            'id'=> $this->primaryKey(),
            'etiqueta_id'=> $this->integer()->notNull(),
            'servicio_id'=> $this->integer()->notNull(),
        ])

        $this->addForeignKey(
            'fk_servicios_etiquetas_servicios',
            'servicios_etiquetas',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_servicios_etiquetas_etiquetas',
            'servicios_etiquetas',
            'etiqueta_id',
            'etiquetas',
            'id',
            'CASCADE'
        );

        $this->createTable('ventas', [
            'id'=> $this->primaryKey(),
            'usuario_id'=>$this->integer()->notNull(),
            'fecha_venta'=>$this->date(),
            'importe' =>$this->decimal(7,2)->notNull(),
            'iva' =>$this->decimal(7,2)->notNull(),
            'descuento' =>$this->decimal(7,2)->notNull()->defaultValue(0),
            'total_venta' =>$this->decimal(7,2)->notNull(),
            'total_comision' =>$this->decimal(7,2)->notNull(),
            ], $tableOptions);

        $this->addForeignKey(
            'fk_ventas_usuarios',
            'ventas',
            'usuario_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createTable('lineas_venta', [
            'id'=> $this->primaryKey(),
            'venta_id'=> $this->integer()->notNull(),
            'cantidad'=>$this->integer()->notNull(),
            'precio_unit' =>$this->decimal(7,2)->notNull(),
            'descuento_linea' =>$this->decimal(7,2)->notNull()->defaultValue(0),
            'total_linea' =>$this->decimal(7,2)->notNull(),
            'total_comision_linea' =>$this->decimal(7,2)->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_lineas_venta_servicios',
            'lineas_venta',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_lineas_venta_ventas',
            'lineas_venta',
            'venta_id',
            'ventas',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('roles');
        $this->dropTable('provincias');
        $this->dropTable('municipios');
        $this->dropTable('paises');
        $this->dropTable('lineas_pedido');
        $this->dropTable('pedidos');
        $this->dropTable('servicios');
        $this->dropTable('migration');
        $this->dropTable('gender');
        $this->dropTable('status');
        $this->dropTable('user_type');

    }
}
