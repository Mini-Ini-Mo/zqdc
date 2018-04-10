<?php

namespace common\widgets\yii2_wechat\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $uid
 * @property string $trade_type 交易类型
 * @property int $total_fee 订单金额
 * @property string $transaction_id 微信支付订单号
 * @property string $out_trade_no 商户订单号
 * @property int $created_at
 * @property int $status 0,1
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'trade_type'], 'required'],
            [['uid', 'total_fee', 'created_at', 'status'], 'integer'],
            [['trade_type'], 'string', 'max' => 50],
            [['transaction_id', 'out_trade_no'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'trade_type' => 'Trade Type',
            'total_fee' => 'Total Fee',
            'transaction_id' => 'Transaction ID',
            'out_trade_no' => 'Out Trade No',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }
}
