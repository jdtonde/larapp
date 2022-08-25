<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory((5))->create();
       

        $user=User::factory()->create([
            'name'=>'John Doe',
            'email'=>'john@gmail.com',
            
        ]);
  
        Listing::factory(6)->create([
            'user_id'=> $user->id
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     'name' => 'Laraval Senior Developer',
        //     'tags' =>'Laravel, Javascript',
        //     'company'=>'Acme Corp',
        //     'location'=>'Boston, MA',
        //     'email' => 'email@email.com',
        //     'website'=> 'https:\/\/www.acme.com ',
        //     'desc' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the',

        // ]);


        // Listing::create([
        //     'name' => 'Fullstack Developer',
        //     'tags' =>'laravel, backend , api',
        //     'company'=>'Stark Industries',
        //     'location'=>'New York, NY',
        //     'email' => 'email12@email.com',
        //     'website' => 'https:\/\/www.starkindutries.com',
        //     'desc' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the',
        // ]);
    }
}
