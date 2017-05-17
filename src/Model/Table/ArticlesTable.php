<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->hasMany('Items', [
            'dependent' => true
        ]);
        $this->belongsTo('Users');
    }

}

?>