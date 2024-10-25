<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = array(
			array('code' => 'Rang', 'name' => 'Panchagar'),
    array('code' => 'Rang', 'name' => 'Thakurgaon'),
    array('code' => 'Rang', 'name' => 'Dinajpur'),
    array('code' => 'Rang', 'name' => 'Nilphamari'),
    array('code' => 'Rang', 'name' => 'Lalmonirhat'),
    array('code' => 'Rang', 'name' => 'Rangpur'),
    array('code' => 'Rang', 'name' => 'Kurigram'),
    array('code' => 'Rang', 'name' => 'Gaibandha'),

    // Rajshahi Division
    array('code' => 'Rajs', 'name' => 'Joypurhat'),
    array('code' => 'Rajs', 'name' => 'Bogura'),
    array('code' => 'Rajs', 'name' => 'Naogaon'),
    array('code' => 'Rajs', 'name' => 'Natore'),
    array('code' => 'Rajs', 'name' => 'Nawabganj'),
    array('code' => 'Rajs', 'name' => 'Rajshahi'),
    array('code' => 'Rajs', 'name' => 'Sirajganj'),
    array('code' => 'Rajs', 'name' => 'Pabna'),

    // Khulna Division
    array('code' => 'Khul', 'name' => 'Kushtia'),
    array('code' => 'Khul', 'name' => 'Meherpur'),
    array('code' => 'Khul', 'name' => 'Chuadanga'),
    array('code' => 'Khul', 'name' => 'Jhenaidah'),
    array('code' => 'Khul', 'name' => 'Magura'),
    array('code' => 'Khul', 'name' => 'Narail'),
    array('code' => 'Khul', 'name' => 'Jashore'),
    array('code' => 'Khul', 'name' => 'Satkhira'),
    array('code' => 'Khul', 'name' => 'Khulna'),
    array('code' => 'Khul', 'name' => 'Bagerhat'),

    // Barishal Division
    array('code' => 'Bari', 'name' => 'Pirojpur'),
    array('code' => 'Bari', 'name' => 'Jhalakati'),
    array('code' => 'Bari', 'name' => 'Barishal'),
    array('code' => 'Bari', 'name' => 'Bhola'),
    array('code' => 'Bari', 'name' => 'Patuakhali'),
    array('code' => 'Bari', 'name' => 'Barguna'),

    // Mymensingh Division
    array('code' => 'Myme', 'name' => 'Netrokona'),
    array('code' => 'Myme', 'name' => 'Mymensingh'),
    array('code' => 'Myme', 'name' => 'Sherpur'),
    array('code' => 'Myme', 'name' => 'Jamalpur'),

    // Dhaka Division
    array('code' => 'Dhak', 'name' => 'Tangail'),
    array('code' => 'Dhak', 'name' => 'Kishoreganj'),
    array('code' => 'Dhak', 'name' => 'Manikganj'),
    array('code' => 'Dhak', 'name' => 'Dhaka'),
    array('code' => 'Dhak', 'name' => 'Gazipur'),
    array('code' => 'Dhak', 'name' => 'Narsingdi'),
    array('code' => 'Dhak', 'name' => 'Narayanganj'),
    array('code' => 'Dhak', 'name' => 'Munshiganj'),
    array('code' => 'Dhak', 'name' => 'Faridpur'),
    array('code' => 'Dhak', 'name' => 'Rajbari'),
    array('code' => 'Dhak', 'name' => 'Gopalganj'),
    array('code' => 'Dhak', 'name' => 'Madaripur'),
    array('code' => 'Dhak', 'name' => 'Shariatpur'),

    // Sylhet Division
    array('code' => 'Sylh', 'name' => 'Sunamganj'),
    array('code' => 'Sylh', 'name' => 'Sylhet'),
    array('code' => 'Sylh', 'name' => 'Moulvibazar'),
    array('code' => 'Sylh', 'name' => 'Habiganj'),

    // Chattogram Division
    array('code' => 'Chat', 'name' => 'Brahmanbaria'),
    array('code' => 'Chat', 'name' => 'Cumilla'),
    array('code' => 'Chat', 'name' => 'Chandpur'),
    array('code' => 'Chat', 'name' => 'Lakshmipur'),
    array('code' => 'Chat', 'name' => 'Noakhali'),
    array('code' => 'Chat', 'name' => 'Feni'),
    array('code' => 'Chat', 'name' => 'Chattogram'),
    array('code' => 'Chat', 'name' => 'Cox’s Bazar'),
    array('code' => 'Chat', 'name' => 'Khagrachhari'),
    array('code' => 'Chat', 'name' => 'Rangamati'),
    array('code' => 'Chat', 'name' => 'Bandarban')
		);
        DB::table('countries')->insert($countries);
    }
}
