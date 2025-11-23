<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\User;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@biomedihub.com')->first();

        $materials = [
            // Semester 1
            [
                'title' => 'Pengantar Teknik Biomedis',
                'description' => 'Materi pengenalan dasar tentang bidang teknik biomedis dan aplikasinya dalam dunia medis.',
                'content' => "Teknik Biomedis adalah cabang ilmu teknik yang menggabungkan prinsip-prinsip engineering dengan ilmu kedokteran dan biologi untuk keperluan kesehatan.\n\nTopik yang dipelajari:\n1. Sejarah Teknik Biomedis\n2. Aplikasi dalam dunia medis\n3. Peralatan medis dasar\n4. Etika profesi\n5. Prospek karir",
                'semester' => 1,
                'mata_kuliah' => 'Pengantar Teknik Biomedis',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Matematika Dasar untuk Teknik',
                'description' => 'Konsep matematika fundamental yang dibutuhkan dalam teknik biomedis.',
                'content' => "Materi mencakup:\n- Kalkulus Diferensial\n- Kalkulus Integral\n- Persamaan Diferensial\n- Aljabar Linear\n- Transformasi Laplace",
                'semester' => 1,
                'mata_kuliah' => 'Matematika Teknik I',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Fisika Dasar - Mekanika',
                'description' => 'Prinsip-prinsip fisika dasar tentang gerak, gaya, dan energi.',
                'content' => "Bab yang dibahas:\n1. Kinematika\n2. Dinamika Newton\n3. Kerja dan Energi\n4. Momentum dan Impuls\n5. Gerak Rotasi",
                'semester' => 1,
                'mata_kuliah' => 'Fisika Dasar',
                'user_id' => $admin->id,
            ],

            // Semester 2
            [
                'title' => 'Anatomi dan Fisiologi Manusia',
                'description' => 'Studi tentang struktur dan fungsi tubuh manusia.',
                'content' => "Sistem yang dipelajari:\n- Sistem Kardiovaskular\n- Sistem Respirasi\n- Sistem Pencernaan\n- Sistem Saraf\n- Sistem Muskuloskeletal\n\nPenting untuk memahami bagaimana tubuh bekerja sebelum merancang alat medis.",
                'semester' => 2,
                'mata_kuliah' => 'Anatomi Fisiologi',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Rangkaian Listrik Dasar',
                'description' => 'Pengenalan komponen dan analisis rangkaian listrik.',
                'content' => "Materi pembelajaran:\n1. Hukum Ohm\n2. Hukum Kirchhoff\n3. Rangkaian DC dan AC\n4. Teorema Rangkaian\n5. Analisis Node dan Mesh",
                'semester' => 2,
                'mata_kuliah' => 'Rangkaian Listrik',
                'user_id' => $admin->id,
            ],

            // Semester 3
            [
                'title' => 'Elektronika Dasar untuk Biomedis',
                'description' => 'Komponen elektronika dan aplikasinya dalam peralatan medis.',
                'content' => "Topik bahasan:\n- Dioda dan Transistor\n- Operational Amplifier (Op-Amp)\n- Filter Analog\n- Power Supply\n- Aplikasi dalam alat medis",
                'semester' => 3,
                'mata_kuliah' => 'Elektronika Biomedis',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Pemrograman Dasar',
                'description' => 'Fundamental pemrograman menggunakan Python untuk analisis biomedis.',
                'content' => "Yang akan dipelajari:\n1. Sintaks Python dasar\n2. Struktur data\n3. Pengolahan data medis\n4. Visualisasi data\n5. Library NumPy dan Matplotlib",
                'semester' => 3,
                'mata_kuliah' => 'Pemrograman Komputer',
                'user_id' => $admin->id,
            ],

            // Semester 4
            [
                'title' => 'Instrumentasi Biomedis I',
                'description' => 'Prinsip kerja dan desain instrumen medis dasar.',
                'content' => "Instrumen yang dipelajari:\n- ECG (Elektrokardiograf)\n- EEG (Elektroensefalograf)\n- EMG (Elektromiograf)\n- Sensor Bio-potensial\n- Pengkondisian Sinyal\n\nSetiap instrumen dijelaskan dari segi elektronika dan aplikasi klinis.",
                'semester' => 4,
                'mata_kuliah' => 'Instrumentasi Biomedis I',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Pengolahan Sinyal Digital',
                'description' => 'Teknik pemrosesan sinyal digital untuk aplikasi biomedis.',
                'content' => "Konsep penting:\n- Sampling dan Aliasing\n- Transformasi Fourier\n- Filter Digital (FIR & IIR)\n- Spektrum Analisis\n- Aplikasi pada sinyal biomedis (ECG, EEG)",
                'semester' => 4,
                'mata_kuliah' => 'Pengolahan Sinyal Digital',
                'user_id' => $admin->id,
            ],

            // Semester 5
            [
                'title' => 'Pencitraan Medis',
                'description' => 'Teknologi dan prinsip kerja berbagai modalitas pencitraan medis.',
                'content' => "Modalitas yang dibahas:\n1. X-Ray dan CT Scan\n2. MRI (Magnetic Resonance Imaging)\n3. Ultrasonografi\n4. PET dan SPECT\n5. Pengolahan Citra Medis\n\nSetiap modalitas dijelaskan dari fisika dasar hingga aplikasi klinis.",
                'semester' => 5,
                'mata_kuliah' => 'Pencitraan Medis',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Biomaterial',
                'description' => 'Material yang digunakan untuk aplikasi medis dan implant.',
                'content' => "Topik pembelajaran:\n- Jenis-jenis biomaterial\n- Biokompatibilitas\n- Material untuk implant\n- Tissue Engineering\n- Degradasi material\n- Standar biomedis",
                'semester' => 5,
                'mata_kuliah' => 'Biomaterial',
                'user_id' => $admin->id,
            ],

            // Semester 6
            [
                'title' => 'Instrumentasi Biomedis II',
                'description' => 'Instrumen medis lanjutan dan sistem monitoring.',
                'content' => "Sistem yang dipelajari:\n- Patient Monitoring System\n- Ventilator Medis\n- Dialysis Machine\n- Infusion Pump\n- Surgical Equipment\n\nFokus pada desain, troubleshooting, dan maintenance.",
                'semester' => 6,
                'mata_kuliah' => 'Instrumentasi Biomedis II',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Sistem Kendali Biomedis',
                'description' => 'Aplikasi sistem kontrol dalam peralatan medis.',
                'content' => "Materi yang dibahas:\n1. Teori Sistem Kontrol\n2. PID Controller\n3. Kontrol pada Ventilator\n4. Kontrol pada Infusion Pump\n5. Feedback System dalam Alat Medis",
                'semester' => 6,
                'mata_kuliah' => 'Sistem Kontrol',
                'user_id' => $admin->id,
            ],

            // Semester 7
            [
                'title' => 'Keselamatan Alat Kesehatan',
                'description' => 'Standar keselamatan dan regulasi alat kesehatan.',
                'content' => "Topik penting:\n- Electrical Safety\n- IEC 60601 Standard\n- Risk Management (ISO 14971)\n- Medical Device Testing\n- Regulatory Affairs\n- Hospital Safety Protocols",
                'semester' => 7,
                'mata_kuliah' => 'Keselamatan Alat Kesehatan',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Telemedicine dan IoT Healthcare',
                'description' => 'Teknologi informasi untuk layanan kesehatan jarak jauh.',
                'content' => "Yang akan dipelajari:\n- Konsep Telemedicine\n- IoT dalam Healthcare\n- Wearable Medical Devices\n- Remote Patient Monitoring\n- Health Information System\n- Data Security & Privacy",
                'semester' => 7,
                'mata_kuliah' => 'Telemedicine',
                'user_id' => $admin->id,
            ],

            // Semester 8
            [
                'title' => 'Manajemen Rumah Sakit',
                'description' => 'Pengelolaan fasilitas dan peralatan kesehatan di rumah sakit.',
                'content' => "Aspek yang dibahas:\n- Hospital Management System\n- Equipment Planning\n- Preventive Maintenance\n- Asset Management\n- Quality Assurance\n- Healthcare Economics",
                'semester' => 8,
                'mata_kuliah' => 'Manajemen Rumah Sakit',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Kewirausahaan Teknologi Kesehatan',
                'description' => 'Pengembangan bisnis di bidang teknologi kesehatan.',
                'content' => "Topik pembelajaran:\n1. Business Model Canvas\n2. Product Development\n3. Regulatory Pathway\n4. Funding & Investment\n5. Marketing Strategy\n6. Startup dalam Healthtech",
                'semester' => 8,
                'mata_kuliah' => 'Kewirausahaan',
                'user_id' => $admin->id,
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
