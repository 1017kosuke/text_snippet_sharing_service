<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Helpers\Settings;

class Wipe extends AbstractCommand
{
    protected static ?string $alias = 'wipe';
    protected static bool $requiredCommandValue = true;
    
    public static function getArguments(): array
    {
        return [
            (new Argument('backup')) -> description('Backs up the database before wiping it.'),
            (new Argument('restore')) -> description('Restores the database from the backup after wiping it.'),
        ];
    }

    public function execute(): int
    {
        $backup = $this->getArgumentValue('backup');
        $restore = $this->getArgumentValue('restore');

        if ($backup) {
            printf("Are You Sure? (Yes/No) ");
            $handle = fopen("php://stdin", "r");
            $line = fgets($handle);
            if (trim($line) != 'Yes') {
                printf("Aborting.\n");
                return 0;
            }
            $this->wipe();
        }

        if ($restore) {
            $this->restore();
        }

        return 0;
    }

    private function wipe(): void {
        $dbUser = Settings::env('DATABASE_USER');
        $dbPassword = Settings::env('DATABASE_USER_PASSWORD');
        $dbName = Settings::env('DATABASE_NAME');

        $command = sprintf(
            'mysqldump -u %s -p%s %s > backup.sql',
            escapeshellarg($dbUser),
            escapeshellarg($dbPassword),
            escapeshellarg($dbName)
        );

        system($command, $exitCode);
    }

    private function restore(): void {
        $dbUser = Settings::env('DATABASE_USER');
        $dbPassword = Settings::env('DATABASE_USER_PASSWORD');
        $dbName = Settings::env('DATABASE_NAME');

        $command = sprintf(
            'mysql -u %s -p%s %s < backup.sql',
            escapeshellarg($dbUser),
            escapeshellarg($dbPassword),
            escapeshellarg($dbName)
        );

        system($command, $exitCode);
    }
}
