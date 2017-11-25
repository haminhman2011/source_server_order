<?php

namespace backend\models\query;

use common\models\User;
use common\utils\query\CustomActiveQuery;

/**
 * This is the ActiveQuery class for [[\backend\models\User]].
 *
 * @see \backend\models\User
 */
class UserQuery extends CustomActiveQuery
{
    /**
     * @return CustomActiveQuery $this
     */
    public function active()
    {
        $this->andWhere(['user.status' => User::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return CustomActiveQuery $this
     */
    public function visible()
    {
        $this->andWhere(['>', 'user.status', User::STATUS_DELETED]);

        return $this;
    }
}
