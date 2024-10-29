<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
        
        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'role' => 'operator',
        ]);
        
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
        ]);

        Product::create([
            'name' => 'Burger',
            'description' => 'Makanan cepat saji yang nikmat dan mengenyangkan, dilapisi dengan 2 roti menyelimuti daging patty yang nikmat dan mengguggah selera',
            'stock' => 20,
            'price' => 40000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Nasi Goreng',
            'description' => 'Nasi yang digoren dengan bawang putih serta rempah-rempah khas Indo yang identik dengan kecap manis',
            'stock' => 50,
            'price' => 35000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Sate',
            'description' => 'Tusukan berupa daging yang dipanggang dengan arang langsung yang dapat dinikmati selagi hangat',
            'stock' => 15,
            'price' => 55000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Bakso',
            'description' => 'Semangkuk Bakso hangat dengan daun bawang yang nikmat yang juga dinikmati dengan mantap bersama kuah kaldunya',
            'stock' => 20,
            'price' => 28000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Breakfast',
            'description' => 'Platter Paket makanan sarapan khas barat yang dinikmati di pagi hari sebelum memulai hari',
            'stock' => 10,
            'price' => 90000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Lasagna',
            'description' => 'Makanan khas Itali yang identik dengan saus tomat yang nikmat lalu dinikmati dengan baik bersamaan dengan pasta yang lebar',
            'stock' => 15,
            'price' => 120000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Nasi Ayam',
            'description' => 'Nasi dengan ayam yang nikmat, dimakan bersama dengan saus kari yang disiapkan dan cocok dengan ayam',
            'stock' => 20,
            'price' => 28000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Piscok',
            'description' => 'Jajanan yang manis berupa sebuah pisang yang diselimuti kulit lumpia dan saus coklat yang manis',
            'stock' => 10,
            'price' => 10000,
            'status' => 'masuk'
        ]);
        Product::create([
            'name' => 'Pecel Lele',
            'description' => 'Makanan yang nyaman berupa nasi dengan ikan lele goreng bersama dengan sambal yang nikmat dan juga khas',
            'stock' => 20,
            'price' => 30000,
            'status' => 'masuk'
        ]);
    }
}