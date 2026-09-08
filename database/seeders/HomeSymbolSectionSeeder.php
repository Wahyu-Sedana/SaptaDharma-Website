<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

/**
 * Creates the two homepage sections introduced by the "Simbol Pribadi Manusia"
 * redesign. Uses firstOrCreate (not updateOrCreate) so re-running this in an
 * environment where an admin has already edited these sections never
 * overwrites their changes — it only fills in the rows if they're missing.
 */
class HomeSymbolSectionSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::where('slug', 'home')->first();

        if (! $page) {
            return;
        }

        $maxSortOrder = Section::where('page_id', $page->id)->max('sort_order') ?? 0;

        $symbolDescriptionId = <<<'HTML'
<p>Wahyu Sapta Darma mempunyai tujuan luhur yaitu hendak menghayu–hayu bahagianya buana. Antara lain membimbing manusia untuk mencapai suatu kebahagiaan hidup di dunia dan Alam Langgeng.</p><p>Guna mencapai cita–cita itu, Sapta Darma menyampaikan petunjuk–petunjuk kepada sekalian manusia, yaitu dengan menyampaikan ajaran–ajaran Sapta Darma yang pertama kali diterima oleh Panuntun Agung Sri Gutama, berkebangsaan Indonesia berasal dari Pare, Kediri, Jawa Timur.</p><p>Adapun sejarah turunnya wahyu wewarah Sapta Darma dengan persaksian sahabat–sahabatnya.</p><p>Tentang inti sari tujuan, cita–cita Wewarah Sapta Darma terperinci sebagai berikut :</p><p>1. Menanamkan tebalnya kepercayaan, dengan menunjukan bukti–bukti secara persaksian, bahwa sesungguhnya Allah itu ada dan tunggal = Esa, serta memiliki lima sila/ sikap perwujudan kehendak yang mutlak, yaitu: Maha Agung, Maha Rokhim, Maha Adil, Maha Wasesa &amp; Maha Langgeng. Menguasai alam semesta beserta isinya yang terjadi. Oleh karena itu manusia wajib mengagungkan Asma Allah, serta setia tuhu menjalankan perintah–perintahNya.</p><p>2. Melatih kesempurnaan Sujud, yaitu berbaktinya manusia pada Hyang Maha Kuasa. Mencapai keluhuran budi dengan cara–cara yang mudah dan sederhana, dapat dijalankan/dilakukan oleh semua umat manusia.</p><p>3. Mendidik manusia bertindak suci dan jujur, mencapai nafsu, budi dan pekerti yang menuju pada keluhuran dan keutamaan guna bekal hidupnya di dunia dan alam Langgeng. Maka Sapta Darma mendidik warganya menjadi Ksatria Utama yang dengan penuh kesusilaan, bertabiat dan bertindak pengasih dan penyayang, suka menolong kepada siapa saja yang sedang menderita dan kegelapan. Juga mendidik warganya untuk dapat hidup dengan kepercayaan atas kekuatan sendiri. Semboyannya: Dimana saja dan kepada siapa saja selalu bersinar laksana surya. Bagi warga Sapta Darma isi Wewarah Tujuh wajib dijalankan dengan sungguh–sungguh serta diamalkan kepada sekalian umat.</p><p>4. Mengajar warganya untuk mengatur hidupnya. Mengingat hidup manusia di dunia adalah rokhaniah dan jasmaniah, maka diwaktu siang diwajibkan bekerja demi mencukupi kebutuhan jasmaniah, sedang diwaktu malam dan di waktu senggang digunakan untuk memenuhi kebutuhan rokhaniah, seperti misalnya : Sujud berbakti pada Hyang Maha Kuasa, serta melatih rasa dan sebagainya. Bila kedua hal tersebut dilakukan secara sungguh–sungguh dan tertib, pasti akan mencapai luhurnya rokhani dan jasmani.</p><p>5. Menjalankan Wewarah Tujuh yang dilandasi melatih kesempurnaan Sujud seperti diutarakan pada nomor 2 tersebut di atas, bila dijalankan dengan ikhlas dan sungguh–sungguh serta penuh rasa yang halus sekali, menurut Sapta Darma: dapat mempengaruhi dan menyebabkan manusia memiliki ketajaman dan kewaspadaan/kawaskitan yang bermacam - macam yang antara lain ialah:</p><p>1. Waskita akan penglihatan =pandulu.</p><p>2. Waskita akan penciuman =pangganda.</p><p>3. Waskita akan pendengaran =pamiarsa.</p><p>4. Waskita akan tutur kata =pangandika dan sebagainya,&nbsp;</p><p>yang telah banyak dibuktikan oleh kebanyakan warga Sapta Darma, umpamanya: Sabda Usada /kata–kata penyembuhan guna menolong orang sakit. Mencapai sabda luhur dan waskita seperti tersebut di atas dapat dilakukan/dilatih di sanggar–sanggar /rumah pasujudan, bersama–sama warga lain dibawah asuhan Tuntunan Sanggar, di waktu malam meskipun hanya sampai jam 23.00 atau 24.00.</p><p>Bila dirumah dan melatih diri, dapat dilakukan dalam segala waktu, di tempat pasujudan yang khusus disediakan, yaitu tempat yang bersih/suci. Berarti tempat tidur sehari–hari tak seyogyanya guna tempat Sujud.&nbsp;</p><p>Jadi bagi Sapta Darma, Sanggar adalah tempat suci yang berarti harus dipingit/disucikan, tidak diperkenankan guna melakukan sembarang kerja yang serba meninggalkan ketentraman dan kesucian, seperti antaranya guna bersenda - gurau guna perbuatan maksiat dan sebagainya.</p><p>&nbsp;</p><p>PERINGATAN</p><p>Bagi para warga serta siapa saja yang menjalankan serta melatih Sujud, Ulah Rasa dan Racut, dilarang keras meninggalkan/ melanggar Wewarah yang diutarakan dalam buku suci ini. Seperti misalnya : bersikap yang tidak susila di waktu Sujud pada Hyang Maha Kuasa.</p><p>Karena itu latihan tersebut sebaiknya dilakukan bersama–sama di sanggar, seyogyanya ada salah satu warga yang diserahi oleh Tuntunan mengawasi sikap warga lainnya.</p><p>6. Memberantas kepercayaan akan takhayul dalam segala macam bentuk dan manifestasinya, karena dewasa ini sebagian besar bangsa Indonesia masih percaya terhadap takhayul dalam alam pikiran atau kebiasaan hidupnya. Hal yang demikian sebetulnya sering menjadikan terhambatnya kemajuan bangsa dalam hidup bersama di dunia ini.</p><p>Sapta Darma mengajarkan kepada manusia untuk melakukan/mengagungkan Allah Hyang Maha Kuasa, serta menyadari bahwa manusia adalah makhluk yang tertinggi martabatnya, dimana hidupnya ada dalam kekuasaanNya.</p><p>Maka dari itu Warga Sapta Darma yang telah melakukan Sujud serta sungguh–sungguh telah menjalankan/mengamalkan isi Wewarah Tujuh, tidak perlu takut akan hari, bulan, musim/waktu–waktu tertentu dan sebagainya guna melaksanakan pekerjaannya.</p><p>Jadi dilarang keras: mengagungkan batu, kayu, serta mengeramatkan segala hasil karya manusia biasa, mengagungkan serta minta pertolongan roh penasaran,jin,setan dan sebagainya.</p><p>Semboyan Warga Sapta Darma:</p><p>&ldquo; Satria Utama yang disayangi serta dilindungi oleh Hyang Maha Kuasa, dijauhkan dari perbuatan dan sikap angkara murka.&rdquo;</p><p>Maka Warga Sapta Darma bila sungguh - sungguh mencita–citakan dengan menjalankan wewarah/ajaran yang telah diajarkan oleh Panuntun Agung Sapta Darma, pasti dapat mencapai kesempurnaan pribadi serta kebahagiaan hidup di dunia dan alam Langgeng.</p>
HTML;

        $sections = [
            [
                'slug' => 'home-symbol',
                'title' => ['id' => 'Simbol Pribadi Manusia', 'en' => 'Symbol of Human Personality'],
                'subtitle' => ['id' => '', 'en' => ''],
                'description' => [
                    'id' => $symbolDescriptionId,
                    'en' => 'The Symbol of Human Personality is the sacred emblem of Sapta Darma, depicting human submission in drawing closer to God Almighty, and serving as a guide toward truth and perfection.',
                ],
            ],
            [
                'slug' => 'home-sasanti',
                'title' => ['id' => 'Sasanti', 'en' => 'Sasanti'],
                'subtitle' => ['id' => '', 'en' => ''],
                'description' => [
                    'id' => 'Hidup dalam kebenaran, berkarya untuk kemanusiaan.',
                    'en' => 'Living in truth, working for humanity.',
                ],
            ],
        ];

        foreach ($sections as $offset => $section) {
            Section::firstOrCreate(
                ['slug' => $section['slug']],
                [
                    'page_id' => $page->id,
                    'title' => $section['title'],
                    'subtitle' => $section['subtitle'],
                    'description' => $section['description'],
                    'sort_order' => $maxSortOrder + $offset + 1,
                    'status' => 'publish',
                ]
            );
        }
    }
}
