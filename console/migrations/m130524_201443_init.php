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

        $this->createTable('user_type', [
            'id'=> $this->primaryKey(),
            'user_type_name'=> $this->string(45)->notNull()->unique(),
            'user_type_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('status', [
            'id'=> $this->primaryKey(),
            'status_name'=> $this->string(45)->notNull()->unique(),
            'status_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('roles', [
            'id'=> $this->primaryKey(),
            'rol_name'=> $this->string(45)->notNull()->unique(),
            'rol_value'=> $this->integer()->notNull()->unique(),
        ], $tableOptions);

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
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('now()'),
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

        $this->createTable('gender', [
            'id'=> $this->primaryKey(),
            'gender_name'=> $this->string(45)->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('profile', [
            'id'=> $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'nombre' => $this->string(255),
            'apellidos' => $this->string(255),
            'gender_id' => $this->integer(),
            'direccion' => $this->string(255),
            'pais_id'=>$this->integer()->defaultValue(1),
            'provincia_id' => $this->integer()->defaultValue(1),
            'municipio_id' => $this->integer()->defaultValue(1),
            'cpostal' => $this->char(5),
            'fecha_nac'=>$this->date(),
            'created_at' => $this->date()->notNull()->defaultExpression('now()'),
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

        $this->createTable('imagen_profile', [
            'id'=> $this->primaryKey(),
            'profile_id' =>$this->integer()->notNull(),
            'url' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('now()'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_imagen_profile_profile',
            'imagen_profile',
            'profile_id',
            'profile',
            'id',
            'CASCADE'
        );

        $this->createTable('tipos_iva', [
            'id'=> $this->primaryKey(),
            'descripcion_iva'=>$this->string(25),
            'porcentaje_iva'=>$this->decimal(7,2),
        ]);

        $this->createTable('unidades_tiempo', [
            'id'=> $this->primaryKey(),
            'plural'=>$this->string(15),
            'singular'=>$this->string(15),
        ]);

        $this->createTable('servicios', [
            'id'=> $this->primaryKey(),
            'descripcion'=>$this->string(255)->notNull(),
            'precio'=>$this->decimal(7,2)->notNull(),
            'proveedor_id'=>$this->integer()->notNull(),
            'activo'=>$this->boolean()->defaultValue(true),
            'tipo_iva_id' => $this->integer()->notNull()->defaultValue(3),
            'duracion' => $this->integer()->notNull()->defaultValue(1),
            'duracion_unidad_id' => $this->integer()->notNull()->defaultValue(1),
            'puntuacion' => $this->integer()->defaultValue(0),
            'num_votos' => $this->integer()->defaultValue(0),
            'media_punt' => $this->decimal(4,2)->defaultValue(0),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_servicios_usuarios',
            'servicios',
            'proveedor_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_servicios_tipos_iva',
            'servicios',
            'tipo_iva_id',
            'tipos_iva',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_servicios_unidades_tiempo',
            'servicios',
            'duracion_unidad_id',
            'unidades_tiempo',
            'id',
            'CASCADE'
        );


        $this->createTable('comentarios', [
            'id'=> $this->primaryKey(),
            'servicio_id' => $this->integer()->notNull(),
            'profile_id' => $this->integer()->notNull(),
            'padre_id' => $this->integer(),
            'comentario' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
        ]);

        $this->addForeignKey(
            'fk_comentarios_servicio',
            'comentarios',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_comentarios_profile',
            'comentarios',
            'profile_id',
            'profile',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_comentarios_comentarios',
            'comentarios',
            'padre_id',
            'comentarios',
            'id',
            'CASCADE'
        );

        $this->createTable('votaciones', [
            'id'=> $this->primaryKey(),
            'servicio_id' => $this->integer()->notNull(),
            'profile_id' => $this->integer()->notNull(),
            'puntuacion' => $this->integer(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
        ]);

        $this->addForeignKey(
            'fk_votaciones_servicios',
            'votaciones',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_votaciones_profile',
            'votaciones',
            'profile_id',
            'profile',
            'id',
            'CASCADE'
        );

        $this->createTable('imagen_servicio', [
            'id'=> $this->primaryKey(),
            'servicio_id' =>$this->integer()->notNull(),
            'descripcion' => $this->string(50)->notNull(),
            'url' => $this->string(255)->notNull(),
            'urlthumb' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull()->defaultExpression('now()'),
            'updated_at' => $this->datetime()->notNull()->defaultExpression('now()'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_imagen_servicio_servicio',
            'imagen_servicio',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->createTable('etiquetas', [
            'id'=> $this->primaryKey(),
            'descripcion_tag'=> $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createTable('servicios_etiquetas', [
            'id'=> $this->primaryKey(),
            'etiqueta_id'=> $this->integer()->notNull(),
            'servicio_id'=> $this->integer()->notNull(),
        ], $tableOptions);

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

        $this->createTable('categorias', [
            'id'=> $this->primaryKey(),
            'descripcion_cat'=> $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createTable('servicios_categorias', [
            'id'=> $this->primaryKey(),
            'categoria_id'=> $this->integer()->notNull(),
            'servicio_id'=> $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_servicios_categorias_servicios',
            'servicios_categorias',
            'servicio_id',
            'servicios',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_servicios_categorias_categorias',
            'servicios_categorias',
            'categoria_id',
            'categorias',
            'id',
            'CASCADE'
        );

        $this->createTable('estado_ventas', [
            'id'=> $this->primaryKey(),
            'estado'=> $this->string(25)->notNull(),
        ], $tableOptions);

        $this->createTable('ventas', [
            'id'=> $this->primaryKey(),
            'usuario_id'=>$this->integer()->notNull(),
            'fecha_venta'=>$this->date(),
            'importe' =>$this->decimal(7,2)->notNull(),
            'descuento' =>$this->decimal(7,2)->notNull()->defaultValue(0),
            'importe_iva' =>$this->decimal(7,2)->notNull(),
            'total_venta' =>$this->decimal(7,2)->notNull(),
            'total_comision' =>$this->decimal(7,2)->notNull(),
            'estado_id' => $this->integer()->notNull(),
            ], $tableOptions);

        $this->addForeignKey(
            'fk_ventas_usuarios',
            'ventas',
            'usuario_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_ventas_estado_ventas',
            'ventas',
            'estado_id',
            'estado_ventas',
            'id',
            'CASCADE'
        );

        $this->createTable('lineas_venta', [
            'id'=> $this->primaryKey(),
            'venta_id'=> $this->integer()->notNull(),
            'servicio_id' => $this->integer()->notNull(),
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
        $this->dropTable('lineas_venta');
        $this->dropTable('ventas');
        $this->dropTable('estado_ventas');
        $this->dropTable('servicios_categorias');
        $this->dropTable('categorias');
        $this->dropTable('servicios_etiquetas');
        $this->dropTable('etiquetas');
        $this->dropTable('imagen_servicio');
        $this->dropTable('votaciones');
        $this->dropTable('comentarios');
        $this->dropTable('servicios');
        $this->dropTable('unidades_tiempo');
        $this->dropTable('tipos_iva');
        $this->dropTable('imagen_profile');
        $this->dropTable('profile');
        $this->dropTable('gender');
        $this->dropTable('user');
        $this->dropTable('roles');
        $this->dropTable('status');
        $this->dropTable('user_type');
        $this->dropTable('municipios');
        $this->dropTable('provincias');
        $this->dropTable('paises');
    }
}
