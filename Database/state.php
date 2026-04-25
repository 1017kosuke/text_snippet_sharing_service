<?php

return [
    'texts' => [
        'id' => [
            'dataType' => 'INT',
            'constraints' => 'AUTO_INCREMENT',
            'primaryKey' => true,
            'nullable' => false,
        ],
        'content' => [
            'dataType' => 'TEXT',
            'nullable' => false,
        ],
        'syntax_highlighted' => [
            'dataType' => 'INT',
            'nullable' => false,
            'default' => 1,
        ],
        'lang' => [
            'dataType' => 'VARCHAR(50)',
            'nullable' => false,
        ],
        'created_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'updated_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
    ],

    'paths' => [
        'id' => [
            'dataType' => 'INT',
            'constraints' => 'AUTO_INCREMENT',
            'primaryKey' => true,
            'nullable' => false,
        ],
        'text_id' => [
            'dataType' => 'INT',
            'nullable' => false,
        ],
        'unique_string' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
            'unique' => true,
        ],
        'duration' => [
            'dataType' => 'INT',
            'nullable' => false,
        ],
        'created_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'updated_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
    ],
];