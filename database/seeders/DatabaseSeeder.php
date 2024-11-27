<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Report;
use App\Models\Ticket;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
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
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role' => 'user',
        ]);

        Category::create([
            'name' => 'Programming',
        ]);
        Category::create([
            'name' => 'Manga',
        ]);
        Category::create([
            'name' => 'Novel',
        ]);

        Product::create([
            'name' => 'Attack On Titan',
            'description' => 'Attack on Titan mengikuti Eren Yeager yang berjuang melawan Titan untuk mengungkap misteri dan melindungi umat manusia.',
            'author' => 'Hajime Isayama', 
            'publisher' => 'Kodansha',
            'stock' => 20,
            'price' => 40000, 
            'category_id'=> 2
        ]);
        Product::create([
            'name' => 'Laskar Pelangi',
            'description' => 'Laskar Pelangi menceritakan perjuangan anak-anak di Belitung meraih impian melalui pendidikan meski menghadapi keterbatasan hidup.',
            'author' => 'Andrea', 
            'publisher' => 'Bentang Pusaka',
            'stock' => 10,
            'price' => 35000,
            'category_id'=> 3
        ]);
        Product::create([
            'name' => 'HTML Book',
            'description' => 'Dasar dasar pemrograman web dengan kerangka HTML',
            'author' => 'Steve Jobs', 
            'publisher' => 'Gramedia',
            'stock' => 10,
            'price' => 60000,
            'category_id'=> 1
        ]);
        Product::create([
            'name' => 'Laravel for Beginners',
            'description' => 'Panduan lengkap untuk pemula dalam membangun aplikasi web menggunakan Laravel.',
            'author' => 'Udin',
            'publisher' => 'Gramedia',
            'stock' => 15,
            'price' => 80000,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Naruto',
            'description' => 'Naruto mengikuti perjalanan seorang ninja muda, Naruto Uzumaki, dalam mencapai cita-cita menjadi Hokage.',
            'author' => 'Masashi Kishimoto',
            'publisher' => 'Shueisha',
            'stock' => 50,
            'price' => 28000,
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Pride and Prejudice',
            'description' => 'Kisah klasik tentang cinta dan pernikahan di Inggris abad ke-19, yang penuh dengan intrik sosial.',
            'author' => 'Jane Austen',
            'publisher' => 'Gramedia',
            'stock' => 30,
            'price' => 50000,
            'category_id' => 3
        ]);

        
    }
}