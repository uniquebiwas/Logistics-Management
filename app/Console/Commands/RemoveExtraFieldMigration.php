<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveExtraFieldMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollback:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Schema::dropIfExists('extra_fields_in');
            // echo " Migration  removed \n";
            //2030_04_30_140203_create_extra_fields_in_table
            $key = 'create_extra_fields_in_table';
            $migration = DB::table('migrations')->where('migration', 'like', '%'.$key.'%')->delete();
            echo "Migration removed \n";
            // $this->command->info('Migration removed!');
            Artisan::call('migrate');
            // $this->command->info("New fields again migrated");
            echo "============== \n";
            echo "New fields again migrated \n";
            // dd($migraiton);
        }catch(\Exception $e){
            echo  $e->getMessage();
        }
    }
}
