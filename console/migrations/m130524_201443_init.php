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
            'nombre_pais'=>$this->string(255)->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('paises',  ['nombre_pais'], [
            ['España'], ['Alemania'], ['Francia'], ['Italia'], ['Marruecos'], ['EEUU'], ['Rusia'], ['Finlandia'], ['Bélgica']
        ]);

        $this->createTable('provincias', [
            'id'=>$this->primaryKey(),
            'nombre_provincia'=>$this->string(25)->notNull()->unique(),
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
            'nombre_municipio'=>$this->string(50)->notNull(),
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
            ['Chipiona', 11], ['Jerez de la Frontera', 11], ['Sanlúcar de Bda.', 11], ['Rota', 11], ['Cádiz', 1], ['El Puerto de Santa María', 11], ['San Fernando', 11],
            ['Dos Hermanas', 41], ['Lebrija', 41], ['Utrera', 41], ['Mairena del Aljarafe', 41], ['Alcalá de Guadaira', 41], ['Coria', 41],
            ['Baeza', 23], ['Úbeda', 23], ['Linares', 23], ['Cazorla', 23], ['Andújar', 23], ['Torredelcampo', 23],
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

        /*
        $this->insert('roles', [
            'rol_name' => 'Usuario Registrado',
        ]);
        $this->insert('roles', [
            'rol_name' => 'Invitado',
        ]);*/

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status_id' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'rol_id'=>$this->integer()->defaultValue(10),
            'user_type_id'=>$this->integer()->defaultValue(10),
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

        /*$this->insert('user', [
            'username' => 'Agustin',
            'email' => 'agustin_1997@yahoo.es',
            'rol_id' => 30, // SuperAdmin
            'user_type_id' => 20,
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'auth_key' => Yii::$app->security->generateRandomString()
        ]);*/
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
            'user_id' => $this->integer(),
            'nombre' => $this->string(255),
            'apellidos' => $this->string(255),
            'gender_id' => $this->integer(),
            'direccion' => $this->string(255),
            'pais_id'=>$this->integer(),
            'municipio_id' => $this->integer(),
            'cpostal' => $this->char(5),
            'provincia_id' => $this->integer(),
            'fecha_nac'=>$this->date(),
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

        $this->createTable('servicios', [
            'id'=> $this->primaryKey(),
            'precio'=>$this->decimal()->notNull(),
            'proveedor_id'=>$this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_servicios_usuarios',
            'servicios',
            'proveedor_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createTable('pedidos', [
            'id'=> $this->primaryKey(),
            'usuario_id'=>$this->integer()->notNull(),
            'fecha_ped'=>$this->date(),
            ], $tableOptions);

        $this->addForeignKey(
            'fk_pedidos_usuarios',
            'pedidos',
            'usuario_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createTable('lineas_pedido', [
            'id'=> $this->primaryKey(),
            'pedido_id'=> $this->integer()->notNull(),
            'cantidad'=>$this->integer()->notNull(),
            'precio'=>$this->decimal()->notNull(),
            'descuento'=>$this->decimal(),
            'precio_linea'=>$this->decimal()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_lineas_pedido_pedidos',
            'lineas_pedido',
            'pedido_id',
            'pedidos',
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
