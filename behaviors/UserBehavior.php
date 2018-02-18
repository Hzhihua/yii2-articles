<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-6 17:23
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\web\UnauthorizedHttpException;

class UserBehavior extends AttributeBehavior
{
    /**
     * record user id filed
     * @var string
     */
    public $userFiled = 'created_by';

    /**
     * {@inheritdoc}
     *
     * @var null
     */
    public $value = null;

    /**
     * @var int
     */
    private $_user;

    /**
     * @var int
     */
    private $_userId;

    /**
     * initialize variables
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->userFiled],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this->userFiled],
            ];
        }
    }

    /**
     * @return \yii\web\User
     */
    public function getUser()
    {
        $this->checkUserLogin();

        if (empty($this->_user)) {
            $this->_user = Yii::$app->getUser()->identity;
        }

        return $this->_user;
    }

    /**
     * check user whether had logined
     */
    public function checkUserLogin()
    {
        if (Yii::$app->getUser()->isGuest) {
            $loginUrl = Yii::$app->getUser()->loginUrl;
            Yii::$app->getResponse()->redirect($loginUrl, 302)->send();
            exit(0);
        }
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        if (empty($this->_userId)) {
            $this->_userId = $this->getUser()->getId();
        }
        return (int) $this->_userId;
    }

    /**
     * {@inheritdoc}
     *
     * @return int|string
     */
    public function getValue($event)
    {
        if ($this->value === null) {
            return $this->value = $this->getUserId();
        }

        return parent::getValue($event);
    }

    /**
     * check user permission
     * @param string $attribute
     * @return bool
     */
    public function checkUserPermission($attribute = 'created_by')
    {
        if ($this->owner->$attribute !== $this->getUserId()) {
            return false;
        }

        return true;
    }

}