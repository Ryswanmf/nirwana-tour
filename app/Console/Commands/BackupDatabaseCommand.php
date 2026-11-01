<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BackupDatabaseCommand extends Command
{
    protected $signature = 'app:backup-database';
    protected $description = 'Cadangkan database Nirwana Tour ke storage/app/backups dan bersihkan cadangan lama (> 14 hari)';

    public function handle(): int
    {
        $backupDir = storage_path('app/backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $connection = config('database.default');
        $timestamp = date('Y-m-d_His');
        $fileName = "nirwana_backup_{$timestamp}";

        try {
            if ($connection === 'sqlite') {
                $dbPath = config('database.connections.sqlite.database');
                if (!File::exists($dbPath)) {
                    $this->error("Database SQLite tidak ditemukan di: {$dbPath}");
                    return 1;
                }
                $destination = "{$backupDir}/{$fileName}.sqlite";
                File::copy($dbPath, $destination);
                $this->info("Backup SQLite berhasil disimpan ke: {$destination}");
            } else {
                $host = config('database.connections.mysql.host', '127.0.0.1');
                $port = config('database.connections.mysql.port', 3306);
                $database = config('database.connections.mysql.database');
                $username = config('database.connections.mysql.username');
                $password = config('database.connections.mysql.password');
                $destination = "{$backupDir}/{$fileName}.sql";

                $command = sprintf(
                    'mysqldump --user=%s --password=%s --host=%s --port=%s %s > %s',
                    escapeshellarg($username),
                    escapeshellarg($password),
                    escapeshellarg($host),
                    escapeshellarg($port),
                    escapeshellarg($database),
                    escapeshellarg($destination)
                );
                @exec($command);
                $this->info("Backup MySQL berhasil disimpan ke: {$destination}");
            }

            // Prune backups older than 14 days
            $files = File::files($backupDir);
            $cutoff = now()->subDays(14)->timestamp;
            $pruned = 0;
            foreach ($files as $file) {
                if ($file->getMTime() < $cutoff) {
                    File::delete($file->getPathname());
                    $pruned++;
                }
            }

            if ($pruned > 0) {
                $this->line("Membersihkan {$pruned} file cadangan lama (> 14 hari).");
            }

            Log::info("Backup database berhasil dijalankan: {$fileName}");
            return 0;
        } catch (\Throwable $e) {
            $this->error("Gagal melakukan backup database: " . $e->getMessage());
            Log::error("Backup database gagal: " . $e->getMessage());
            return 1;
        }
    }
}
