<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `frontend\models\Profile`.
 */
class ProfileSearch extends Profile {

    public $genderName;
    public $gender_id;
    public $user_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'gender_id'], 'integer'],
            [['nombre', 'apellidos', 'fecha_nac', 'userId'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'gender_id' => Yii::t('frontend', 'Gender'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = Profile::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'nombre',
                'apellidos',
                'fecha_nac',
                'genderName' => [
                    'asc' => ['gender.gender_name' => SORT_ASC],
                    'desc' =>  ['gender.gender_name' => SORT_DESC],
                    'label' => Yii::t('frontend', 'Gender'),
                ],
                'profileIdLink' =>  [
                    'asc' => ['profile.id' => SORT_ASC],
                    'desc' =>  ['profile.id' => SORT_DESC],
                    'label' => Yii::t('frontend', 'Id'),
                ],
                'userLink' =>  [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' =>  ['user.username' => SORT_DESC],
                    'label' => Yii::t('frontend', 'User'),
                ],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['gender'])
                       ->joinWith(['user']);
            return $dataProvider;
       }

        $this->addSearchParameter($query, 'profile.id');
        $this->addSearchParameter($query, 'nombre', true);
        $this->addSearchParameter($query, 'apellidos', true);
        $this->addSearchParameter($query, 'fecha_nac');
        $this->addSearchParameter($query, 'created_at');
        $this->addSearchParameter($query, 'updated_at');
        $this->addSearchParameter($query, 'user_id');

        // filtrado por el género
        $query->joinWith(['gender' => function ($q) {
            $q->where("gender.gender_name LIKE '%" . $this->genderName . "%''");
        }])
        ->joinWith(['user' => function ($q) {
            $q->where("user.id LIKE '%" . $this->userId . "%''");
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
