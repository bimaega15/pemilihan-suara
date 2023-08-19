<?php

namespace Database\Seeders;

use App\Models\Konfigurasi;
use Illuminate\Database\Seeder;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Konfigurasi::create([
            'cominimal_konfigurasi' => 0,
            'volminimal_konfigurasi' => 0,
            'nama_konfigurasi' => 'Rancang Bangun Aplikasi
            Pemetaan dan Pengelolaan Data Pemenangan Calon Legislatif DPD PAN',
            'logo_konfigurasi' => 'default.png',
            'nohp_konfigurasi' => '082277506232',
            'alamat_konfigurasi' => 'Jakarta',
            'email_konfigurasi' => 'votingsuara15@gmail.com',
            'deskripsi_konfigurasi' => '
            Aplikasi voting suara adalah perangkat lunak atau aplikasi yang digunakan untuk memfasilitasi proses pemungutan suara atau voting dalam berbagai konteks, baik dalam pemilihan umum, pemilihan kepemimpinan organisasi, jajak pendapat, atau acara lain yang memerlukan pengumpulan suara dari sejumlah orang.

                Contoh beberapa jenis aplikasi voting suara adalah:

                    Aplikasi Pemilihan Umum: Aplikasi semacam ini dapat digunakan dalam pemilihan umum untuk memungkinkan pemilih memberikan suara secara elektronik, bukan melalui kertas dan kotak suara konvensional.

                    Aplikasi Pemilihan Kepemimpinan Organisasi: Organisasi atau lembaga dapat menggunakan aplikasi voting suara untuk memilih pemimpin baru atau mengambil keputusan penting melalui suara anggota.

                    Aplikasi Jajak Pendapat: Media, perusahaan, atau kelompok lain dapat menggunakan aplikasi voting suara untuk mengumpulkan opini atau pandangan dari audiens mereka.

                    Aplikasi Rapat dan Konferensi: Dalam acara rapat atau konferensi, aplikasi voting suara dapat digunakan untuk melakukan pemungutan suara mengenai masalah tertentu atau mengambil keputusan secara kolektif.

                    Aplikasi Reality Show: Beberapa acara reality show mungkin menggunakan aplikasi voting suara untuk memungkinkan pemirsa memberikan suara mereka pada kontestan favorit mereka.

                    Aplikasi Pengambilan Keputusan Kelompok: Dalam kelompok atau tim kerja, aplikasi voting suara dapat membantu memperlancar proses pengambilan keputusan dengan cepat dan efisien.
            ',
            'facebook_konfigurasi' => 'www.facebook.com/votingsuara15',
            'instagram_konfigurasi' => '@votingsuara15',
            'youtube_konfigurasi' => 'www.youtube.com/votingsuara15',
            'created_konfigurasi' => 'Voting Suara @ TA',
            'longitude_konfigurasi' => '106.6647014',
            'latitude_konfigurasi' => '-6.2293796'
        ]);
    }
}
