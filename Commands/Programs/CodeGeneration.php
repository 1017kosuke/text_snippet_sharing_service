<?php


namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class CodeGeneration extends AbstractCommand
{
    // 使用するコマンド名を設定
    protected static ?string $alias = 'code-gen';

    // 引数を割り当て
    public static function getArguments(): array
    {
        return [
        ];
    }

    public function execute(): int
    {
        $codeGenType = $this->getCommandValue();

        $filePath = __DIR__ . '/' . $codeGenType . '.php';;
        
        file_put_contents($filePath, "<?php\n\nnamespace Commands\Programs;\n\nuse Commands\AbstractCommand;\nuse Commands\Argument;\n\nclass $codeGenType extends AbstractCommand\n{\n    protected static ?string \$alias = '$codeGenType';\n\n    public static function getArguments(): array\n    {\n        return [\n        ];\n    }\n\n    public function execute(): int\n    {\n        // コード生成のロジックをここに実装\n        return 0;\n    }\n}\n");



        $this->log('Generating code for.......' . $codeGenType);
        return 0;
    }
}