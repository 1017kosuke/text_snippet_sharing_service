<?php

namespace Database\Seeds;

use Database\AbstractSeeder;

class PathsSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'paths';
    protected array $tableColumns = [
        [
            'data_type' => 'int',
            'column_name' => 'id',
        ],
        [
            'data_type' => 'int',
            'column_name' => 'text_id',
        ],
        [
            'data_type' => 'string',
            'column_name' => 'unique_string',
        ],
        [
            'data_type' => 'int',
            'column_name' => 'duration',
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
                1,
                'abc123',
                3600,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
            ],
            [
                2,
                2,
                'def456',
                3600,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
            ],
        ];
    }
}

