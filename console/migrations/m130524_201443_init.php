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
        ]);

        $this->createTable('provincias', [
            'id'=>$this->primaryKey(),
            'desc_provincia'=>$this->string(25)->notNull()->unique(),
            'pais_id'=>$this->integer()->notNull(),
        ]);

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
        ]);

        $this->addForeignKey(
            'fk_municipios_provincias',
            'municipios',
            'provincia_id',
            'provincias',
            'id',
            'CASCADE'
        );

        $this->createTable('roles', [
            'id'=> $this->primaryKey(),
            'den_rol'=> $this->string(50)->notNull()->unique(),
        ], $tableOptions);
        $this->insert('roles', [
            'den_rol' => 'SuperAdmin',
        ]);
        $this->insert('roles', [
            'den_rol' => 'Administrador',
        ]);
        $this->insert('roles', [
            'den_rol' => 'Proveedor',
        ]);
        $this->insert('roles', [
            'den_rol' => 'Usuario Registrado',
        ]);
        $this->insert('roles', [
            'den_rol' => 'Invitado',
        ]);

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
            'nombre' => $this->string(255),
            'apellidos' => $this->string(255),
            'direccion' => $this->string(255),
            'pais_id'=>$this->integer(),
            'municipio_id' => $this->integer(),
            'cpostal' => $this->char(5),
            'provincia_id' => $this->integer(),
            'fecha_nac'=>$this->date(),
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
            'fk_user_paises',
            'user',
            'pais_id',
            'paises',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_provincias',
            'user',
            'provincia_id',
            'provincias',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_user_municipios',
            'user',
            'municipio_id',
            'municipios',
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

        // Inserta el usuario SuperAdmin
        $user = new User();
        $user->username = 'admin1';
        $user->email = 'agustin.lorenzi@gmail.com';
        $user->rol_id = 1;
        $user->setPassword('123456');
        $user->generateAuthKey();
        return $user->save() ? $user : null;

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
