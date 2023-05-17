<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            'pickup',
            'delivery',
            'restaurant_reservation',
        ];

        Transaction::truncate();

        foreach($transactions as $transaction){
            Transaction::create([
                'name' => $transaction
            ]);
        }
    }
}
