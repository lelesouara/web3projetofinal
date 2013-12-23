<?php
class Denuncia extends AppModel {
    public $name = 'Denuncia';
    public $belongsTo = 'User';
    public $hasAndBelongsToMany = array(
        'Tags' =>
        array(
            'className' => 'Tag',
            'joinTable' => 'denuncias_tags',
            'foreignKey' => 'denuncia_id',
            'associationForeignKey' => 'tag_id',
            'unique' => true,
        )
    );
}
?>