<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'category' => 'Fiksi',
                'publisher' => 'KPG',
                'stock' => 12,
                'published_year' => 2017,
                'description' => 'Perjalanan aktivis mahasiswa era 90-an yang hilang akibat penculikan politik.',
                'cover' => 'covers/laut-bercerita.jpg',
            ],
            [
                'title' => 'Bumi (Serial Bumi)',
                'author' => 'Tere Liye',
                'category' => 'Fiksi',
                'publisher' => 'Gramedia',
                'stock' => 20,
                'published_year' => 2014,
                'description' => 'Petualangan Raib, Seli, dan Ali menjelajahi dunia paralel.',
                'cover' => 'covers/bumi-serial-bumi.jpg',
            ],
            [
                'title' => 'Pulang',
                'author' => 'Tere Liye',
                'category' => 'Fiksi',
                'publisher' => 'Republika',
                'stock' => 15,
                'published_year' => 2015,
                'description' => 'Kisah hidup Bujang dalam dunia shadow economy.',
                'cover' => 'covers/pulang.jpg',
            ],
            [
                'title' => 'Perahu Kertas',
                'author' => 'Dewi Lestari',
                'category' => 'Fiksi',
                'publisher' => 'Bentang',
                'stock' => 10,
                'published_year' => 2008,
                'description' => 'Cerita cinta Kugy dan Keenan yang penuh perjalanan seni.',
                'cover' => 'covers/perahu-kertas.jpg',
            ],
            [
                'title' => 'Harry Potter and the Sorcerer’s Stone',
                'author' => 'J.K. Rowling',
                'category' => 'Fiksi',
                'publisher' => 'Bloomsbury',
                'stock' => 18,
                'published_year' => 1997,
                'description' => 'Petualangan pertama Harry Potter di Hogwarts.',
                'cover' => 'covers/harry-potter-sorcerers-stone.jpg',
            ],

            [
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'category' => 'Non-Fiksi',
                'publisher' => 'Kompas',
                'stock' => 14,
                'published_year' => 2018,
                'description' => 'Stoisisme modern untuk menghadapi emosi negatif.',
                'cover' => 'covers/filosofi-teras.jpg',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'category' => 'Non-Fiksi',
                'publisher' => 'Penguin',
                'stock' => 25,
                'published_year' => 2018,
                'description' => 'Membangun kebiasaan kecil untuk perubahan besar.',
                'cover' => 'covers/atomic-habits.jpg',
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert T. Kiyosaki',
                'category' => 'Non-Fiksi',
                'publisher' => 'Plata Publishing',
                'stock' => 20,
                'published_year' => 1997,
                'description' => 'Perbedaan pola pikir orang kaya dan miskin.',
                'cover' => 'covers/rich-dad-poor-dad.jpg',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'category' => 'Non-Fiksi',
                'publisher' => 'Harper',
                'stock' => 9,
                'published_year' => 2011,
                'description' => 'Sejarah evolusi manusia dari purba hingga modern.',
                'cover' => 'covers/sapiens-brief-history-of-humankind.jpg',
            ],
            [
                'title' => 'Berani Tidak Disukai',
                'author' => 'Ichiro Kishimi & Fumitake Koga',
                'category' => 'Non-Fiksi',
                'publisher' => 'Gramedia',
                'stock' => 17,
                'published_year' => 2013,
                'description' => 'Filosofi Adlerian tentang kebebasan diri.',
                'cover' => 'covers/berani-tidak-disukai.jpg',
            ],

            // 3. PENDIDIKAN / AKADEMIK (3)
            [
                'title' => 'Metodologi Penelitian Kuantitatif',
                'author' => 'Sugiyono',
                'category' => 'Pendidikan / Akademik',
                'publisher' => 'Alfabeta',
                'stock' => 30,
                'published_year' => 2015,
                'description' => 'Langkah-langkah penelitian kuantitatif.',
                'cover' => 'covers/metodologi-penelitian-kuantitatif.jpg',
            ],
            [
                'title' => 'Psikologi Pendidikan',
                'author' => 'Nana Syaodih',
                'category' => 'Pendidikan / Akademik',
                'publisher' => 'Rosdakarya',
                'stock' => 21,
                'published_year' => 2016,
                'description' => 'Konsep psikologi dalam proses belajar mengajar.',
                'cover' => 'covers/psikologi-pendidikan.jpg',
            ],
            [
                'title' => 'Research Design: Qualitative, Quantitative, and Mixed Methods Approaches',
                'author' => 'John W. Creswell',
                'category' => 'Pendidikan / Akademik',
                'publisher' => 'SAGE Publications',
                'stock' => 12,
                'published_year' => 2020,
                'description' => 'Panduan penting untuk merancang penelitian kualitatif, kuantitatif, dan metode campuran.',
                'cover' => 'covers/research-design.jpg',
            ],

            // 4. TEKNOLOGI & KOMPUTER (3)
            [
                'title' => 'Logika Pemrograman Python',
                'author' => 'Abdul Kadir',
                'category' => 'Teknologi & Komputer',
                'publisher' => 'Elex Media Komputindo',
                'stock' => 10,
                'published_year' => 2019,
                'description' => 'Pengenalan konsep dasar Python untuk pemula dengan contoh kode yang mudah dipahami.',
                'cover' => 'covers/logika-python.jpg',
            ],

            [
                'title' => 'Python Crash Course',
                'author' => 'Eric Matthes',
                'category' => 'Teknologi & Komputer',
                'publisher' => 'No Starch Press',
                'stock' => 18,
                'published_year' => 2019,
                'description' => 'Buku pemula untuk belajar Python.',
                'cover' => 'covers/python-crash-course.jpg',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'category' => 'Teknologi & Komputer',
                'publisher' => 'Prentice Hall',
                'stock' => 11,
                'published_year' => 2008,
                'description' => 'Prinsip menulis kode yang bersih dan mudah dirawat.',
                'cover' => 'covers/clean-code.jpg',
            ],

            // 5. BISNIS & EKONOMI (3)
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'category' => 'Bisnis & Ekonomi',
                'publisher' => 'Crown Business',
                'stock' => 13,
                'published_year' => 2011,
                'description' => 'Metode membangun bisnis cepat melalui eksperimen.',
                'cover' => 'covers/the-lean-startup.jpg',
            ],
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'category' => 'Bisnis & Ekonomi',
                'publisher' => 'Farrar, Straus and Giroux',
                'stock' => 9,
                'published_year' => 2011,
                'description' => 'Dua sistem berpikir manusia dalam keputusan.',
                'cover' => 'covers/thinking-fast-and-slow.jpg',
            ],
            [
                'title' => 'Start With Why',
                'author' => 'Simon Sinek',
                'category' => 'Bisnis & Ekonomi',
                'publisher' => 'Portfolio',
                'stock' => 16,
                'published_year' => 2009,
                'description' => 'Konsep Why dalam kepemimpinan dan motivasi bisnis.',
                'cover' => 'covers/start-with-why.jpg',
            ],

            // 6. SENI & DESAIN (2)
            [
                'title' => 'Dasar-Dasar Desain Grafis',
                'author' => 'Suryo Sukendro',
                'category' => 'Seni & Desain',
                'publisher' => 'Gramedia',
                'stock' => 7,
                'published_year' => 2014,
                'description' => 'Pengantar elemen dan prinsip desain.',
                'cover' => 'covers/dasar-dasar-desain-grafis.jpg',
            ],
            [
                'title' => 'The Art of Color',
                'author' => 'Johannes Itten',
                'category' => 'Seni & Desain',
                'publisher' => 'Wiley',
                'stock' => 6,
                'published_year' => 1997,
                'description' => 'Teori warna dalam seni modern.',
                'cover' => 'covers/the-art-of-color.jpg',
            ],

            // 7. KESEHATAN (2)
            [
                'title' => 'Kesehatan Masyarakat: Ilmu dan Seni',
                'author' => 'Soekidjo Notoatmodjo',
                'category' => 'Kesehatan & Kedokteran',
                'publisher' => 'Rineka Cipta',
                'stock' => 12,
                'published_year' => 2011,
                'description' => 'Buku yang mengulas konsep dasar kesehatan masyarakat sebagai ilmu dan seni dalam upaya meningkatkan derajat kesehatan masyarakat.',
                'cover' => 'covers/kesehatan-masyarakat-ilmu-dan-seni.jpg',
            ],

            [
                'title' => 'Principles of Anatomy & Physiology',
                'author' => 'Gerard J. Tortora & Bryan H. Derrickson',
                'category' => 'Kesehatan & Kedokteran',
                'publisher' => 'Wiley',
                'stock' => 8,
                'published_year' => 2014,
                'description' => 'Referensi lengkap struktur dan fungsi organ tubuh manusia.',
                'cover' => 'covers/principles-of-anatomy-physiology.jpg',
            ],

            // 8. AGAMA (2)
            [
                'title' => 'Tafsir Al-Mishbah',
                'author' => 'M. Quraish Shihab',
                'category' => 'Agama',
                'publisher' => 'Lentera Hati',
                'stock' => 10,
                'published_year' => 2000,
                'description' => 'Tafsir Al-Qur’an modern dan kontekstual.',
                'cover' => 'covers/tafsir-al-mishbah.jpg',
            ],
            [
                'title' => 'Sirah Nabawiyah',
                'author' => 'Ibnu Hisyam',
                'category' => 'Agama',
                'publisher' => 'Darul Fikr',
                'stock' => 6,
                'published_year' => 1990,
                'description' => 'Riwayat hidup Nabi Muhammad SAW.',
                'cover' => 'covers/sirah-nabawiyah.jpg',
            ],

            [
                'title' => 'Doraemon: Petualangan Nobita dalam Dunia Misteri',
                'author' => 'Fujiko F. Fujio',
                'category' => 'Anak & Remaja',
                'publisher' => 'Shogakukan',
                'stock' => 22,
                'published_year' => 1993,
                'description' => 'Petualangan Nobita dan Doraemon menjelajahi Dunia Misteri.',
                'cover' => 'covers/doraemon.jpg',
            ],
            [
                'title' => 'Komik Si Juki: Jalan-Jalan Nusantara',
                'author' => 'Faza Meonk',
                'category' => 'Anak & Remaja',
                'publisher' => 'Bukune',
                'stock' => 19,
                'published_year' => 2018,
                'description' => 'Humor Si Juki mengenalkan budaya Indonesia.',
                'cover' => 'covers/komik-si-juki-jalan-jalan-nusantara.jpg',
            ],
            [
                'title' => 'The Maze Runner',
                'author' => 'James Dashner',
                'category' => 'Anak & Remaja',
                'publisher' => 'Delacorte Press',
                'stock' => 15,
                'published_year' => 2009,
                'description' => 'Remaja yang terjebak dalam labirin misterius.',
                'cover' => 'covers/the-maze-runner.jpg',
            ],

            [
                'title' => 'Sejarah Dunia untuk Pembaca Muda',
                'author' => 'Ernst H. Gombrich',
                'category' => 'Sejarah & Budaya',
                'publisher' => 'Marjin Kiri',
                'stock' => 7,
                'published_year' => 2016,
                'description' => 'Ringkasan sejarah dunia dari zaman kuno hingga era modern untuk pembaca muda.',
                'cover' => 'covers/sejarah-dunia-untuk-pembaca-muda.jpg',
            ],
            [
                'title' => 'Nusantara: Sejarah Indonesia',
                'author' => 'Bernard H.M. Vlekke',
                'category' => 'Sejarah & Budaya',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'stock' => 10,
                'published_year' => 2008,
                'description' => 'Sejarah Indonesia dari periode pra-kolonial hingga masa modern secara komprehensif.',
                'cover' => 'covers/nusantara-sejarah-indonesia.jpg',
            ],
            [
                'title' => 'The Culture Map',
                'author' => 'Erin Meyer',
                'category' => 'Sejarah & Budaya',
                'publisher' => 'PublicAffairs',
                'stock' => 8,
                'published_year' => 2014,
                'description' => 'Panduan memahami perbedaan budaya global dalam komunikasi, keputusan, dan gaya kerja.',
                'cover' => 'covers/the-culture-map.jpg',
            ],

        ];

        foreach ($books as $data) {
            Book::firstOrCreate(
                [
                    'title' => $data['title'],
                    'author' => $data['author'],
                ],
                $data
            );
        }
    }
}
