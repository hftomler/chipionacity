<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{

    /**
     * attributes
     * 
     * @var mixed
     */    

    public $rolName;
    public $userTypeName;
    public $user_type_name;
    public $user_type_id;
    public $statusName;
    public $profileId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rol_id', 'status_id', 'user_type_id'], 'integer'],
            [['username', 'email', 'created_at', 'updated_at', 'rolName', 'statusName', 'userTypeName', 'profileId', 'user_type_name'], 'safe'],
            [['proveedor'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
        * Setup your sorting attributes
        * Note: This is setup before the $this->load($params)
        * statement below
        */

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'userIdLink' => [
                    'asc' => ['user.id' => SORT_ASC],
                    'desc' => ['user.id' => SORT_DESC],
                    'label' => 'User'
                ],
                    'userLink' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => 'User'
                ],
                    'profileLink' => [
                    'asc' => ['profile.id' => SORT_ASC],
                    'desc' => ['profile.id' => SORT_DESC],
                    'label' => 'Profile'
                ],
                    'rolName' => [
                    'asc' => ['rol.rol_name' => SORT_ASC],
                    'desc' => ['rol.rol_name' => SORT_DESC],
                    'label' => 'Rol'
                ],
                    'statusName' => [
                    'asc' => ['status.status_name' => SORT_ASC],
                    'desc' => ['status.status_name' => SORT_DESC],
                    'label' => 'Status'
                            ],
                    'userTypeName' => [
                    'asc' => ['user_type.user_type_name' => SORT_ASC],
                    'desc' => ['user_type.user_type_name' => SORT_DESC],
                    'label' => 'User Type'
                ],
                    'created_at' => [        
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'label' => 'Created At'
                ],
                    'email' => [
                    'asc' => ['email' => SORT_ASC],
                    'desc' => ['email' => SORT_DESC],
                    'label' => 'Email'
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['rol'])
                ->joinWith(['status'])
                ->joinWith(['profile'])
                ->joinWith(['userType']);
            return $dataProvider;
        }

        $this->addSearchParameter($query,'user.id');
        $this->addSearchParameter($query,'username', true);
        $this->addSearchParameter($query,'email', true);
        $this->addSearchParameter($query,'rol_id');
        $this->addSearchParameter($query,'status_id');
        $this->addSearchParameter($query,'user_type_id');
        $this->addSearchParameter($query,'created_at');
        $this->addSearchParameter($query,'updated_at');


        // Filtrar por rol
        $query->joinWith(['rol' => function ($q) {
                $q->where("roles.rol_name LIKE '%" . $this->rolName . "%'");
            }])
        // Filtrar por status
              ->joinWith(['status' => function ($q) {
                $q->where("status.status_name LIKE '%" . $this->statusName . "%'");
            }])
        // Filtrar por tipo de usuario
              ->joinWith(['userType' => function ($q) {
                $q->where("user_type.user_type_name LIKE '%" . $this->userTypeName . "%'");
            }]);

        return $dataProvider;
    }

    protected function addSearchParameter($query, $attribute, $partialMatch = false) {

        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }
        
        $value = $this->$modelAttribute;
        
        if (trim($value) === '') {
            return;
        }
        /*
        * The following line is additionally added for right aliasing
        * of columns so filtering happen correctly in the self join
        */

        $attribute = "user.$attribute";
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
