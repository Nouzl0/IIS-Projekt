<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The path to the database.sql file
        $sql_file = database_path("database.sql");

        // Read the SQL file (File::get) and then execute the SQL (DB::unprepared)
        DB::unprepared(File::get($sql_file));
    }
}
