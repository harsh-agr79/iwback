<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Crypt;

class clearvfcode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cvfc';

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
        $vfcodes = DB::table('companies')->where('extra5','<', time()+300)->update([
            'extra4'=>Crypt::encrypt(rand(1111111111,999999999999999)),
            'extra5'=>'999999999999999999',
        ]);

        dd($vfcodes);
        return Command::SUCCESS;
    }
}
