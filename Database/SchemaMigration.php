<?php

namespace Database;

interface SchemaMigration
{
    public function up(): void;
    public function down(): void;
}