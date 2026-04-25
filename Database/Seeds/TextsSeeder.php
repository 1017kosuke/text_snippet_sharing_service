<?php

namespace Database\Seeds;

require_once __DIR__ . '/../AbstractSeeder.php';

use Database\AbstractSeeder;

class TextsSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'texts';
    protected array $tableColumns = [
        [
            'data_type' => 'int',
            'column_name' => 'id',
        ],
        [
            'data_type' => 'string',
            'column_name' => 'content',
        ],
        [
            'data_type' => 'string',
            'column_name' => 'lang',
        ],
        [
            'data_type' => 'int',
            'column_name' => 'syntax_highlighted',
        ],
        [
            'data_type' => 'string',
            'column_name' => 'created_at',
        ],
        [
            'data_type' => 'string',
            'column_name' => 'updated_at',
        ],
    ];


    public function createRowData(): array
    {
        return [
            [
                1,
                'Hello, World!',
                'python',
                0,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
            ],
            [
                2,
                'print("Hello, World!")',
                'javascript',
                1,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
            ],
        ];
    }
}