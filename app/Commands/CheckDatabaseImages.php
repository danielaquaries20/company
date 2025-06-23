<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckDatabaseImages extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'app';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'check:db-images';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Check image settings in database with actual file names';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'check:db-images';

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $db = \Config\Database::connect();

        CLI::write('Checking image settings in database...', 'yellow');

        // Ambil semua settings yang berkaitan dengan gambar
        $imageSettings = $db->table('company_settings')
            ->whereIn('setting_key', ['hero_background_image', 'company_logo', 'about_image'])
            ->get()
            ->getResultArray();

        foreach ($imageSettings as $setting) {
            $value = $setting['setting_value'];
            if (!empty($value)) {
                $filePath = FCPATH . 'assets/images/uploads/' . $value;
                $status = file_exists($filePath) ? '✅' : '❌';
                CLI::write("{$status} {$setting['setting_key']}: {$value}");
            } else {
                CLI::write("⚪ {$setting['setting_key']}: (empty)");
            }
        }

        CLI::newLine();
        CLI::write('Available uploaded files:', 'yellow');

        $uploadDir = FCPATH . 'assets/images/uploads/';
        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && $file !== 'README.md') {
                    CLI::write("📁 {$file}");
                }
            }
        }

        CLI::newLine();
        CLI::write('To assign images to settings, go to admin panel: ' . base_url('admin/settings'), 'green');
    }
}
