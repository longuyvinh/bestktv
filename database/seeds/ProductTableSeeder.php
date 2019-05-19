<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Anh Sẽ Về Sớm Thôi',
            'slug' => 'anh-se-ve-som-thoi',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Áo Tím Chiều Nay',
            'slug' => 'ao-tim-chieu-nay',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Bến Xưa',
            'slug' => 'ben-xua',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Bóng Chiều',
            'slug' => 'bong-chieu',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Cố Quên Một Người Không Xứng Đáng',
            'slug' => 'co-quen-mot-nguoi-khong-xung-dang',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Đi Tìm Một Nửa',
            'slug' => 'di-tim-mot-nua',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Còn Trong Nỗi Nhớ',
            'slug' => 'con-trong-noi-nho',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Đời Không Còn Nhau',
            'slug' => 'doi-khong-con-nhau',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Một Đời Vẫn Nhớ',
            'slug' => 'mot-doi-van-nho',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Một Phút Đam Mê',
            'slug' => 'mot-phut-dam-me',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Mưa Còn Rơi Mãi Vì Ai',
            'slug' => 'mua-con-roi-mai-vi-ai',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'beat',
            'name' => 'Mười Năm Một Chặng Đường',
            'slug' => 'muoi-nam-mot-chang-duong',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Anh Sẽ Về Sớm Thôi',
            'slug' => 'anh-se-ve-som-thoi-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Áo Tím Chiều Nay',
            'slug' => 'ao-tim-chieu-nay-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Bến Xưa',
            'slug' => 'ben-xua-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Bóng Chiều',
            'slug' => 'bong-chieu-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Chờ Một Tiếng Yêu',
            'slug' => 'cho-mot-tieng-yeu',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Có Em Chờ',
            'slug' => 'co-em-cho',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Còn Trong Nỗi Nhớ',
            'slug' => 'con-trong-noi-nho-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Đà Lạt Trong Niềm Nhớ',
            'slug' => 'da lat trong niem nho',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Đêm Sông Hàn',
            'slug' => 'dem-song-han',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Đi Tìm Một Nửa',
            'slug' => 'di-tim-mot-nua-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Đời Không Còn Nhau',
            'slug' => 'doi-khong-con-nhau-karaoke',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);

        DB::table('products')->insert([
            'category' => 'karaoke',
            'name' => 'Duyên Số',
            'slug' => 'duyen so',
            'description' => 'description goes here',
            'price_usd' => 12.50,
            'price_vnd' => 250
        ]);
    }
}
