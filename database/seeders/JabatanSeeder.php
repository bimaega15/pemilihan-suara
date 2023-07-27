<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id' => 1,
                'nama_jabatan' => 'KETUA',
                'keterangan_jabatan' => 'Majelis Penasehat Partai Wilayah (MPPW)',
                'membawahi_jabatan' => null,
            ],
            [
                'id' => 2,
                'nama_jabatan' => 'KETUA',
                'keterangan_jabatan' => 'Dewan Pimpinan Wilayah (DPW)',
                'membawahi_jabatan' => null,


            ],
            [
                'id' => 3,
                'nama_jabatan' => 'SEKRETARIS WILAYAH',
                'keterangan_jabatan' => '',
                'membawahi_jabatan' => null,


            ],
            [
                'id' => 4,
                'nama_jabatan' => 'WAKIL KETUA',
                'keterangan_jabatan' => '',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 5,
                'nama_jabatan' => 'BENDAHARA WILAYAH',
                'keterangan_jabatan' => '',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 6,
                'nama_jabatan' => 'ANGGOTA MPPW',
                'keterangan_jabatan' => '',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 7,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pengembangan Organisasi dan Keanggotaan (POK)',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 8,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Perkaderan',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 9,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pemenangan Pemilu',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 10,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pemberdayaan Organisasi Mitra dan Organisasi Otonom (BMO)',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 10,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pengembangan Pemuda dan Olahraga',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 11,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Penelitian dan Pengembangan',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 12,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pengembangan dan Perlindungan Tani dan Nelayan',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 13,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pendidikan dan Agama',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 14,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Bantuan Hukum dan Advokasi',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 15,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pemberdayaan Perempuan dan Perlindungan Anak',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 16,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pengembangan Koperasi Usaha Mikro, Kecil, dan Menengah (UMKM)',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 17,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Pengembangan dan Perlindungan Buruh dan Perindustrian',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 18,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Konservasi dan Pemberdayaan Sumber Daya Alam (SDA), Energi, Lingkungan Hidup, dan Penanggulangan Bencana',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 19,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Saksi Wilayah',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 20,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Budaya dan Industri Kreatif',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 21,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Komunikasi dan Informasi Publik',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 22,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Kesehatan',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 23,
                'nama_jabatan' => 'Badan',
                'keterangan_jabatan' => 'Kesejahteraan Masyarakat',
                'membawahi_jabatan' => null,

            ],
            [
                'id' => 24,
                'nama_jabatan' => 'Biro',
                'keterangan_jabatan' => '',
                'membawahi_jabatan' => null,
            ],
        ];
        Jabatan::insert($data);
    }
}
