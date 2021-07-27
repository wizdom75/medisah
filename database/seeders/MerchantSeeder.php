<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create(
            [
                'name' => 'medisah',
                'domain' => 'admin',
                'address_line_1' => '1 Long Lane'
            ]
        );
    }
}
