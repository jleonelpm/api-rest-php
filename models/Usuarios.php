<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int|null $role 1:Admin,2 Vendedor 
 * @property int|null $status 1: activo 0: inactivo 
 * @property string $auth_key
 *
 * @property Tickets[] $tickets
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'auth_key'], 'required'],
            [['role', 'status'], 'integer'],
            [['email', 'password', 'auth_key'], 'string', 'max' => 45],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['usuarios_id' => 'id']);
    }
}
