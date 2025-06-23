<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AssignUploadedImages extends BaseCommand
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
    protected $name = 'assign:uploaded-images';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Assign uploaded images to company settings for demo purposes';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'assign:uploaded-images';

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $db = \Config\Database::connect();

        CLI::write('Assigning uploaded images to company settings...', 'yellow');

        $uploadDir = FCPATH . 'assets/images/uploads/';
        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            $imageFiles = [];

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && $file !== 'README.md') {
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $imageFiles[] = $file;
                    }
                }
            }

            if (count($imageFiles) >= 3) {
                // Assign first image as hero background
                $db->table('company_settings')
                    ->where('setting_key', 'hero_background_image')
                    ->update(['setting_value' => $imageFiles[0], 'updated_at' => date('Y-m-d H:i:s')]);
                CLI::write("✅ Assigned {$imageFiles[0]} as hero_background_image");

                // Assign second image as company logo
                $db->table('company_settings')
                    ->where('setting_key', 'company_logo')
                    ->update(['setting_value' => $imageFiles[1], 'updated_at' => date('Y-m-d H:i:s')]);
                CLI::write("✅ Assigned {$imageFiles[1]} as company_logo");

                // Assign third image as about image
                $db->table('company_settings')
                    ->where('setting_key', 'about_image')
                    ->update(['setting_value' => $imageFiles[2], 'updated_at' => date('Y-m-d H:i:s')]);
                CLI::write("✅ Assigned {$imageFiles[2]} as about_image");

                CLI::newLine();
                CLI::write('🚀 Images assigned successfully!', 'green');
                CLI::write('Visit your website to see the images: ' . base_url(), 'green');
            } else {
                CLI::write('❌ Need at least 3 images in uploads directory', 'red');
                CLI::write('Found ' . count($imageFiles) . ' images: ' . implode(', ', $imageFiles));
            }
        } else {
            CLI::write('❌ Upload directory not found', 'red');
        }
    }
}
