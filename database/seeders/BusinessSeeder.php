<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::beginTransaction();
        try{
            $categories = Category::get();
            $transactions = Transaction::get();

            $businesses = Business::factory()
                ->has(Location::factory())
                ->count(60)
                ->create();

            foreach($businesses as $business){
                $business->Transactions()->attach($transactions);
            }

            foreach($businesses as $business){
                $business->Categories()->attach($categories);
            }


            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }

        Schema::enableForeignKeyConstraints();
    }
}
