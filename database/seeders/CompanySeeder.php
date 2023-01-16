<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,20) as $index) {
            Company::create([
                'name' => "name{$index}",
                'email' => "email{$index}@demo.com",
                'logo' => "logo{$index}.png",
                'website' =>  "test{$index}.com"
            ]);
        }
    }
}