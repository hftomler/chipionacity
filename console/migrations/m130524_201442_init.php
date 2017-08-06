<?php
use yii\db\Migration;
use common\models\User;
class m130524_201442_init extends Migration
{
    public function up()
    {
/*       $this->dropTable('roles');
        $this->dropTable('usuarios');
        $this->dropTable('items');
        $this->dropTable('servicios');
        $this->dropTable('paquetes');
        $this->dropTable('lineas_paquetes');
*/
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        // Creo las tablas  e inserto los valores iniciales.
        $this->createTable('provincias', [
            'id'=>$this->primaryKey(),
            'desc_provincia'=>$this->string(25)->notNull()->unique(),
        ]);
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
            'den_rol' => 'Administador',
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
        $this->createTable('usuarios', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'rol_id'=>$this->integer()->defaultValue(4),
            'nombre' => $this->string(255),
            'apellidos' => $this->string(255),
            'direccion' => $this->string(255),
            'municipio_id' => $this->integer(),
            'cpostal' => $this->char(5),
            'provincia_id' => $this->integer(),
            'fecha_nac'=>$this->date(),
            'proveedor'=>$this->boolean()->defaultValue(false),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_usuarios_roles',
            'usuarios',
            'rol_id',
            'roles',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_usuarios_provincias',
            'usuarios',
            'provincia_id',
            'provincias',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_usuarios_municipios',
            'usuarios',
            'municipio_id',
            'municipios',
            'id',
            'CASCADE'
        );
        $this->createTable('items', [
            'id'=> $this->primaryKey(),
            'tipo'=> $this->char()->notNull()->defaultValue('S')->check("tipo in('S', 'P')"),
            'precio'=>$this->decimal()->notNull(),
        ], $tableOptions);
        $this->createIndex('idxUniqueIdTipoItems', 'items', 'id, tipo', true);
        $this->createTable('servicios', [
            'id'=> $this->primaryKey(),
            'tipo'=> $this->char()->notNull()->defaultValue('S')->check("tipo='S'"),
            'precio'=>$this->decimal()->notNull(),
            'proveedor_id'=>$this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_servicios_usuarios',
            'servicios',
            'proveedor_id',
            'usuarios',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_servicios_tipos',
            'servicios',
            ['id', 'tipo'],
            'items',
            ['id', 'tipo'],
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_servicios_tipos_id',
            'servicios',
            'id',
            'items',
            'id',
            'CASCADE'
        );
        $this->createTable('paquetes', [
            'id'=> $this->primaryKey(),
            'tipo'=> $this->char()->notNull()->defaultValue('P')->check("tipo='P'"),
            'precio'=>$this->decimal()->notNull(),
            'descuento'=>$this->decimal(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_paquetes_tipos',
            'paquetes',
            ['id', 'tipo'],
            'items',
            ['id', 'tipo'],
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_paquetes_tipos_id',
            'paquetes',
            'id',
            'items',
            'id',
            'CASCADE'
        );
        $this->createTable('lineas_paquetes', [
            'id'=> $this->primaryKey(),
            'paquete_id'=> $this->integer()->notNull(),
            'servicio_id'=> $this->integer()->notNull(),
            'cantidad'=>$this->integer()->notNull(),
            'precio'=>$this->decimal()->notNull(),
            'descuento'=>$this->decimal(),
            'precio_linea'=>$this->decimal()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_lineas_paquetes_paquetes',
            'lineas_paquetes',
            'paquete_id',
            'paquetes',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_lineas_paquetes_servicios',
            'lineas_paquetes',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );
        // Creo un nuevo usuario Admin
        $user = new User();
        $user->username = 'Admin';
        $user->email = 'agustin.lorenzi@gmail.com';
        $user->setPassword('123456');
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
    public function down()
    {
        $this->dropTable('usuarios');
    }
}
