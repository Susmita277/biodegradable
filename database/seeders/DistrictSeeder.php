<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $valley = ['Kathmandu', 'Lalitpur', 'Bhaktapur'];

        $districts = [
            'Bhojpur' => 'Koshi',
            'Dhankuta' => 'Koshi',
            'Ilam' => 'Koshi',
            'Jhapa' => 'Koshi',
            'Khotang' => 'Koshi',
            'Morang' => 'Koshi',
            'Okhaldhunga' => 'Koshi',
            'Panchthar' => 'Koshi',
            'Sankhuwasabha' => 'Koshi',
            'Solukhumbu' => 'Koshi',
            'Sunsari' => 'Koshi',
            'Taplejung' => 'Koshi',
            'Terhathum' => 'Koshi',
            'Udayapur' => 'Koshi',

            'Bara' => 'Madhesh',
            'Dhanusa' => 'Madhesh',
            'Mahottari' => 'Madhesh',
            'Parsa' => 'Madhesh',
            'Rautahat' => 'Madhesh',
            'Saptari' => 'Madhesh',
            'Sarlahi' => 'Madhesh',
            'Siraha' => 'Madhesh',

            'Bhaktapur' => 'Bagmati',
            'Chitwan' => 'Bagmati',
            'Dhading' => 'Bagmati',
            'Dolakha' => 'Bagmati',
            'Kathmandu' => 'Bagmati',
            'Kavrepalanchok' => 'Bagmati',
            'Lalitpur' => 'Bagmati',
            'Makwanpur' => 'Bagmati',
            'Nuwakot' => 'Bagmati',
            'Ramechhap' => 'Bagmati',
            'Rasuwa' => 'Bagmati',
            'Sindhuli' => 'Bagmati',
            'Sindhupalchok' => 'Bagmati',

            'Baglung' => 'Gandaki',
            'Gorkha' => 'Gandaki',
            'Kaski' => 'Gandaki',
            'Lamjung' => 'Gandaki',
            'Manang' => 'Gandaki',
            'Mustang' => 'Gandaki',
            'Myagdi' => 'Gandaki',
            'Nawalpur' => 'Gandaki',
            'Parbat' => 'Gandaki',
            'Syangja' => 'Gandaki',
            'Tanahun' => 'Gandaki',

            'Arghakhanchi' => 'Lumbini',
            'Banke' => 'Lumbini',
            'Bardiya' => 'Lumbini',
            'Dang' => 'Lumbini',
            'Eastern Rukum' => 'Lumbini',
            'Gulmi' => 'Lumbini',
            'Kapilvastu' => 'Lumbini',
            'Palpa' => 'Lumbini',
            'Parasi' => 'Lumbini',
            'Pyuthan' => 'Lumbini',
            'Rolpa' => 'Lumbini',
            'Rupandehi' => 'Lumbini',

            'Dailekh' => 'Karnali',
            'Dolpa' => 'Karnali',
            'Humla' => 'Karnali',
            'Jajarkot' => 'Karnali',
            'Jumla' => 'Karnali',
            'Kalikot' => 'Karnali',
            'Mugu' => 'Karnali',
            'Salyan' => 'Karnali',
            'Surkhet' => 'Karnali',
            'Western Rukum' => 'Karnali',

            'Achham' => 'Sudurpashchim',
            'Baitadi' => 'Sudurpashchim',
            'Bajhang' => 'Sudurpashchim',
            'Bajura' => 'Sudurpashchim',
            'Dadeldhura' => 'Sudurpashchim',
            'Darchula' => 'Sudurpashchim',
            'Doti' => 'Sudurpashchim',
            'Kailali' => 'Sudurpashchim',
            'Kanchanpur' => 'Sudurpashchim',
        ];

        foreach ($districts as $name => $province) {
            $charge = match (true) {
                in_array($name, $valley) => 100,
                in_array($province, ['Karnali', 'Sudurpashchim']) => 300,
                default => 200,
            };

            District::firstOrCreate(
                ['name' => $name],
                [
                    'province' => $province,
                    'delivery_charge' => $charge,
                    'is_active' => true,
                ]
            );
        }
    }
}