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
            'desc_pais'=>$this->string(255)->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('provincias', [
            'id'=>$this->primaryKey(),
            'desc_provincia'=>$this->string(25)->notNull()->unique(),
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

        $this->createTable('user_type', [
            'id'=> $this->primaryKey(),
            'user_type_name'=> $this->string(45)->notNull()->unique(),
            'user_type_value'=> $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('user_type', [
            'user_type_name' => 'Gratuito',
            'user_type_value' => '10',
        ]);

        $this->insert('user_type', [
            'user_type_name' => 'Suscrito',
            'user_type_value' => '30',
        ]);

        $this->createTable('status', [
            'id'=> $this->primaryKey(),
            'status_name'=> $this->string(45)->notNull()->unique(),
            'status_value'=> $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('status', [
            'status_name' => 'Activo',
            'status_value' => '10',
        ]);
        $this->insert('status', [
            'status_name' => 'Pendiente',
            'status_value' => '5',
        ]);


        $this->createTable('roles', [
            'id'=> $this->primaryKey(),
            'rol_name'=> $this->string(45)->notNull()->unique(),
            'rol_value'=> $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('roles', [
            'rol_name' => 'user',
            'rol_value' => '10',
        ]);
        $this->insert('roles', [
            'rol_name' => 'admin',
            'rol_value' => '20',
        ]);
        /*
        $this->insert('roles', [
            'rol_name' => 'Proveedor',
        ]);
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
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_user_type',
            'user',
            'user_type_id',
            'user_type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_status',
            'user',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );

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

        $this->insert('gender' [
            'gender_name' => 'Indeterm.',
        ]);


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
            'fk_lineas_pedidos_pedidos',
            'lineas_pedido',
            'pedido_id',
            'pedidos',
            'id',
            'CASCADE'
        );

        /* Inserta el usuario SuperAdmin
        $user = new User();
        $user->username = 'admin1';
        $user->email = 'agustin.lorenzi@gmail.com';
        $user->rol_id = 1;
        $user->setPassword('123456');
        $user->generateAuthKey();
        return $user->save() ? $user : null;*/

    }

    public function down()
    {
        $this->dropTable('lineas_paquetes');
        $this->dropTable('servicios');
        $this->dropTable('paquetes');
        $this->dropTable('items');
        $this->dropTable('user');
        $this->dropTable('user');
        $this->dropTable('roles');
        $this->dropTable('municipios');
        $this->dropTable('provincias');
    }
}
