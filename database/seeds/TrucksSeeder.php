<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrucksSeeder extends Seeder
{

    /**
     * The Carbon::now instance.
     *
     * @var $timestamp
     */
    protected $timestamp;

    /**
     * The trucks array.
     *
     * @var $trucks
     */
    protected $trucks;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->timestamp = Carbon::now()->toDateTimeString();
        $this->trucks =
            [
                '0' => ['vehicle_type'=>'Caminhão 3/4',
                    'code'=>1,'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
                '1' => ['vehicle_type'=>'Caminhão Toco',
                    'code'=>2,'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
                '2' => ['vehicle_type'=>'Caminhão ​Truck',
                    'code'=>3,'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
                '3' => ['vehicle_type'=>'Carreta Simples',
                    'code'=>4,'created_at' => $this->timestamp, 'updated_at' => $this->timestamp],
                '4' => ['vehicle_type'=>'Carreta Eixo Extendido',
                    'code'=>5,'created_at' => $this->timestamp, 'updated_at' => $this->timestamp]
            ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        DB::table('trucks')->delete();
        foreach ($this->trucks as $truck){
            DB::table('trucks')->insert([
                $truck
            ]);

        }

    }
}
