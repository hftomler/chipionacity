<?php
namespace frontend\models;

use yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $pais_id;
    public $municipio_id;
    public $provincia_id;
    public $cpostal;
    public $fecha_nac;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('frontend','This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['email', 'nombre', 'apellidos', 'direccion', 'fecha_nac'], 'string', 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('frontend','This email address has already been taken.')],

            [['pais_id', 'municipio_id', 'provincia_id'], 'integer'],
            ['cpostal', 'string', 'max' => 5],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->nombre = $this->nombre;
        $user->apellidos = $this->apellidos;
        $user->direccion = $this->direccion;
        $user->pais_id = $this->pais_id;
        $user->municipio_id = $this->municipio_id;
        $user->provincia_id = $this->provincia_id;
        $user->cpostal = $this->cpostal;
        $user->fecha_nac = $this->fecha_nac;
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
