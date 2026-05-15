<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin User ────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@yfh.dev'],
            [
                'name'     => 'Yoel Feliks Hutabarat',
                'email'    => 'admin@yfh.dev',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // ─── Settings ─────────────────────────────────────────────────────────
        $settings = [
            // General
            ['key' => 'site_title',       'value' => 'Yoel Feliks Hutabarat — Fullstack Developer',      'type' => 'text',     'group' => 'general', 'label' => 'Site Title'],
            ['key' => 'site_description', 'value' => 'Portfolio & Personal Website',                      'type' => 'text',     'group' => 'general', 'label' => 'Site Description'],
            ['key' => 'site_logo',        'value' => null,                                                'type' => 'image',    'group' => 'general', 'label' => 'Site Logo'],
            ['key' => 'favicon',          'value' => null,                                                'type' => 'image',    'group' => 'general', 'label' => 'Favicon'],
            ['key' => 'cv_file',          'value' => null,                                                'type' => 'file',     'group' => 'general', 'label' => 'CV File (PDF)'],
            ['key' => 'profile_photo',    'value' => null,                                                'type' => 'image',    'group' => 'general', 'label' => 'Profile Photo'],

            // Hero
            ['key' => 'hero_greeting',    'value' => 'Hello, I\'m',                                       'type' => 'text',     'group' => 'hero', 'label' => 'Greeting Text'],
            ['key' => 'hero_name',        'value' => 'Yoel Feliks Hutabarat',                             'type' => 'text',     'group' => 'hero', 'label' => 'Full Name'],
            ['key' => 'hero_roles',       'value' => 'Fullstack Developer,Laravel Developer,AI Web Developer,Backend Developer', 'type' => 'text', 'group' => 'hero', 'label' => 'Roles (comma-separated)'],
            ['key' => 'hero_subtitle',    'value' => 'Building modern web applications with clean code and innovative solutions.', 'type' => 'textarea', 'group' => 'hero', 'label' => 'Subtitle/Tagline'],

            // About
            ['key' => 'about_title',      'value' => 'About Me',                                          'type' => 'text',     'group' => 'about', 'label' => 'Section Title'],
            ['key' => 'about_bio',        'value' => "Fresh Graduate D3 Teknik Informatika dari Politeknik Negeri Batam dengan pengalaman dalam pengembangan aplikasi web berbasis Laravel, Vue 3, MySQL, dan Tailwind CSS.\n\nMemiliki pengalaman membangun sistem rekrutmen perusahaan, sistem AI monitoring kendaraan, dan smart parking berbasis IoT. Adaptif, cepat belajar, dan berorientasi pada solusi.", 'type' => 'textarea', 'group' => 'about', 'label' => 'Bio / About Text'],
            ['key' => 'about_gpa',        'value' => '3.61',                                               'type' => 'text',     'group' => 'about', 'label' => 'GPA'],
            ['key' => 'about_university', 'value' => 'Politeknik Negeri Batam',                            'type' => 'text',     'group' => 'about', 'label' => 'University'],
            ['key' => 'about_degree',     'value' => 'D3 Teknik Informatika',                              'type' => 'text',     'group' => 'about', 'label' => 'Degree'],
            ['key' => 'about_year',       'value' => '2025',                                               'type' => 'text',     'group' => 'about', 'label' => 'Graduation Year'],

            // Contact
            ['key' => 'contact_email',    'value' => 'yoelfeliks@gmail.com',                               'type' => 'text',     'group' => 'contact', 'label' => 'Email Address'],
            ['key' => 'contact_phone',    'value' => '+62 812-3456-7890',                                   'type' => 'text',     'group' => 'contact', 'label' => 'Phone / WhatsApp'],
            ['key' => 'contact_location', 'value' => 'Batam, Kepulauan Riau, Indonesia',                   'type' => 'text',     'group' => 'contact', 'label' => 'Location'],

            // Social
            ['key' => 'social_github',    'value' => 'https://github.com/yoelfeliks',                     'type' => 'text',     'group' => 'social', 'label' => 'GitHub URL'],
            ['key' => 'social_linkedin',  'value' => 'https://linkedin.com/in/yoelfeliks',                 'type' => 'text',     'group' => 'social', 'label' => 'LinkedIn URL'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/yoelfeliks',                   'type' => 'text',     'group' => 'social', 'label' => 'Instagram URL'],
            ['key' => 'social_whatsapp',  'value' => 'https://wa.me/6281234567890',                        'type' => 'text',     'group' => 'social', 'label' => 'WhatsApp URL'],

            // SEO
            ['key' => 'seo_meta_title',   'value' => 'Yoel Feliks Hutabarat | Fullstack Web Developer',   'type' => 'text',     'group' => 'seo', 'label' => 'Meta Title'],
            ['key' => 'seo_meta_description', 'value' => 'Portfolio Yoel Feliks Hutabarat — Fresh Graduate Fullstack Web Developer specializing in Laravel, Vue 3, and AI integration.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Meta Description'],
            ['key' => 'seo_keywords',     'value' => 'laravel developer, fullstack developer, vue 3, portfolio, web developer batam', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Keywords'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // ─── Skills ───────────────────────────────────────────────────────────
        $skills = [
            // Frontend
            ['name' => 'Vue 3',        'category' => 'frontend', 'level' => 85, 'icon' => 'vue',        'sort_order' => 1],
            ['name' => 'JavaScript',   'category' => 'frontend', 'level' => 80, 'icon' => 'js',         'sort_order' => 2],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'level' => 90, 'icon' => 'tailwind',   'sort_order' => 3],
            ['name' => 'Bootstrap',    'category' => 'frontend', 'level' => 85, 'icon' => 'bootstrap',  'sort_order' => 4],
            ['name' => 'Inertia.js',   'category' => 'frontend', 'level' => 80, 'icon' => 'inertia',    'sort_order' => 5],
            // Backend
            ['name' => 'PHP',          'category' => 'backend',  'level' => 88, 'icon' => 'php',        'sort_order' => 1],
            ['name' => 'Laravel',      'category' => 'backend',  'level' => 90, 'icon' => 'laravel',    'sort_order' => 2],
            ['name' => 'REST API',     'category' => 'backend',  'level' => 82, 'icon' => 'api',        'sort_order' => 3],
            // Database
            ['name' => 'MySQL',        'category' => 'database', 'level' => 85, 'icon' => 'mysql',      'sort_order' => 1],
            // AI & Integration
            ['name' => 'YOLOv8',       'category' => 'ai',       'level' => 75, 'icon' => 'yolo',       'sort_order' => 1],
            ['name' => 'Tesseract OCR','category' => 'ai',       'level' => 72, 'icon' => 'ocr',        'sort_order' => 2],
            ['name' => 'Python Dasar', 'category' => 'ai',       'level' => 65, 'icon' => 'python',     'sort_order' => 3],
            // Tools
            ['name' => 'GitHub',       'category' => 'tools',    'level' => 88, 'icon' => 'github',     'sort_order' => 1],
            ['name' => 'VS Code',      'category' => 'tools',    'level' => 92, 'icon' => 'vscode',     'sort_order' => 2],
            ['name' => 'Figma',        'category' => 'tools',    'level' => 70, 'icon' => 'figma',      'sort_order' => 3],
            ['name' => 'Draw.io',      'category' => 'tools',    'level' => 75, 'icon' => 'drawio',     'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'category' => $skill['category']],
                array_merge($skill, ['is_active' => true])
            );
        }

        // ─── Experience ───────────────────────────────────────────────────────
        Experience::updateOrCreate(
            ['company' => 'PT Patria Maritim Perkasa', 'position' => 'IT Developer Intern'],
            [
                'company'          => 'PT Patria Maritim Perkasa',
                'position'         => 'IT Developer Intern',
                'description'      => 'Mengembangkan sistem informasi rekrutmen berbasis web untuk mendukung proses HR perusahaan.',
                'responsibilities' => [
                    'Mengembangkan sistem informasi rekrutmen berbasis web',
                    'Merancang dan mengimplementasikan workflow tracking recruitment',
                    'Membangun sistem multi-role access (Admin, HR, Applicant)',
                    'Pengembangan frontend menggunakan Vue 3 + Inertia.js',
                    'Backend development dengan Laravel framework',
                    'Manajemen database MySQL dan query optimization',
                    'System optimization, debugging, dan testing',
                ],
                'location'         => 'Batam, Kepulauan Riau',
                'type'             => 'internship',
                'tech_stack'       => ['Laravel', 'Vue 3', 'Inertia.js', 'MySQL', 'Tailwind CSS'],
                'start_date'       => '2025-07-01',
                'end_date'         => '2026-03-31',
                'is_current'       => true,
                'sort_order'       => 1,
                'is_active'        => true,
            ]
        );

        // ─── Projects ─────────────────────────────────────────────────────────
        $projects = [
            [
                'title'            => 'Tax Corner',
                'slug'             => 'tax-corner',
                'description'      => 'Aplikasi web informasi dan edukasi perpajakan dengan kalkulator pajak interaktif dan quiz pajak.',
                'long_description' => 'Tax Corner adalah platform edukasi perpajakan yang dirancang untuk membantu masyarakat memahami kewajiban pajak mereka. Dilengkapi dengan kalkulator pajak yang akurat, quiz interaktif untuk menguji pemahaman, dan artikel informasi perpajakan terkini.',
                'category'         => 'Web Application',
                'tech_stack'       => ['Laravel', 'Tailwind CSS', 'MySQL', 'JavaScript'],
                'features'         => ['Informasi dan artikel pajak', 'Kalkulator pajak otomatis', 'Quiz pajak interaktif', 'Responsive UI/UX design', 'Admin dashboard manajemen konten'],
                'demo_url'         => null,
                'github_url'       => null,
                'sort_order'       => 1,
                'is_featured'      => true,
                'is_active'        => true,
            ],
            [
                'title'            => 'SIPPP Smart Parking',
                'slug'             => 'sippp-smart-parking',
                'description'      => 'Sistem smart parking berbasis IoT dan AI dengan deteksi kendaraan real-time dan OCR plat nomor.',
                'long_description' => 'SIPPP (Sistem Informasi Parkir Pintar Politeknik) adalah sistem parkir cerdas yang mengintegrasikan IoT, computer vision, dan web dashboard. Sistem ini mampu mendeteksi kendaraan secara otomatis, membaca plat nomor menggunakan Tesseract OCR, dan menyajikan data real-time melalui dashboard admin.',
                'category'         => 'IoT + AI Web System',
                'tech_stack'       => ['Laravel', 'MySQL', 'YOLOv8', 'Tesseract OCR', 'Python', 'IoT'],
                'features'         => ['Smart parking monitoring real-time', 'Vehicle detection dengan YOLOv8', 'OCR plat nomor otomatis (Tesseract)', 'Dashboard statistik occupancy', 'Notifikasi slot penuh/tersedia', 'Riwayat kendaraan dan laporan'],
                'demo_url'         => null,
                'github_url'       => null,
                'sort_order'       => 2,
                'is_featured'      => true,
                'is_active'        => true,
            ],
            [
                'title'            => 'PINHEL — AI Monitoring System',
                'slug'             => 'pinhel-ai-monitoring',
                'description'      => 'Sistem monitoring AI untuk deteksi pengendara tanpa helm dan identifikasi plat nomor otomatis.',
                'long_description' => 'PINHEL (Pintar Helm) adalah sistem monitoring berbasis kecerdasan buatan yang dirancang untuk meningkatkan keselamatan berkendara. Sistem menggunakan YOLOv8 untuk mendeteksi pengendara yang tidak menggunakan helm, serta secara otomatis mengidentifikasi plat nomor kendaraan. Data pelanggaran disimpan dan ditampilkan melalui dashboard admin Laravel.',
                'category'         => 'AI Monitoring System',
                'tech_stack'       => ['Laravel', 'MySQL', 'YOLOv8', 'Python', 'Computer Vision'],
                'features'         => ['Deteksi pengendara tanpa helm real-time', 'Identifikasi dan logging plat nomor otomatis', 'Dashboard monitoring pelanggaran', 'Laporan dan statistik pelanggaran', 'Integrasi AI (YOLOv8) dengan backend Laravel', 'Alert sistem notifikasi'],
                'demo_url'         => null,
                'github_url'       => null,
                'sort_order'       => 3,
                'is_featured'      => true,
                'is_active'        => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }

        // ─── Testimonials ─────────────────────────────────────────────────────
        Testimonial::updateOrCreate(
            ['name' => 'Supervisor PT Patria Maritim'],
            [
                'name'       => 'Supervisor PT Patria Maritim',
                'position'   => 'IT Supervisor',
                'company'    => 'PT Patria Maritim Perkasa',
                'content'    => 'Yoel menunjukkan kemampuan teknis yang sangat baik selama magang. Ia mampu mengembangkan sistem rekrutmen dari nol dengan cepat dan menghasilkan kode yang bersih dan terstruktur. Sangat adaptif dan cepat belajar.',
                'rating'     => 5,
                'sort_order' => 1,
                'is_active'  => true,
            ]
        );
    }
}
