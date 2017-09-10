<?php

use Illuminate\Database\Seeder;
use App\PenjagaTPS;

class DaftarPenjagaTPSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penjaga_TPS = [
        	['nama'=> 'Hana Nabilah','npm'=>'1306365650','id_fakultas'=>'2', 'imei' => '352251063497301'],
        	['nama'=> 'Febrina Nabilah','npm'=>'1306363941','id_fakultas'=>'2', 'imei' => '352251063497302'],

        	['nama'=> 'Nabila Salsabila','npm'=>'1306370700','id_fakultas'=>'3', 'imei' => '352251063497303'],
        	['nama'=> 'Nabila Marasabessy','npm'=>'1306367782','id_fakultas'=>'3', 'imei' => '352251063497310'],
        	
        	['nama'=> 'Ghinaa Soraya Andria','npm'=>'1406567454','id_fakultas'=>'4', 'imei' => '863336025280599'],
        	['nama'=> 'Siti Aisyah','npm'=>'1406623392','id_fakultas'=>'4', 'imei' => '863336025280607'],

        	['nama'=> 'Nabilah Siti Samiyah','npm'=>'1406528705','id_fakultas'=>'6', 'imei' => '352251063497304'],
        	['nama'=> 'Ghina Karisma','npm'=>'1406528623','id_fakultas'=>'6', 'imei' => '864223030611901'],

        	['nama'=> 'Ghina Rafifa','npm'=>'1706003616','id_fakultas'=>'7', 'imei' => '352251063497305'],
        	['nama'=> 'Niken Rahmawati','npm'=>'1606855741','id_fakultas'=>'7', 'imei' => '864223030611902'],

        	['nama'=> 'Ghina Fauziah','npm'=>'1406545005','id_fakultas'=>'8', 'imei' => '352251063497306'],
        	['nama'=> 'Niken Rachma Sayekti','npm'=>'1406528112','id_fakultas'=>'8', 'imei' => '864223030611903'],

        	['nama'=> 'Niken Yuniar Sari','npm'=>'1506707392','id_fakultas'=>'9', 'imei' => '352251063497307'],
        	['nama'=> 'Niken Fitri Astuti	','npm'=>'1506707386','id_fakultas'=>'9', 'imei' => '864223030611904'],

        	['nama'=> 'Siti Aisyah Adri','npm'=>'1406568671','id_fakultas'=>'10', 'imei' => '352251063497308'],
        	['nama'=> 'Mutiara Nabila','npm'=>'1406555385','id_fakultas'=>'10', 'imei' => '864223030611905'],

        	['nama'=> 'Tamara Hanum Ghina Zalfa','npm'=>'1506755132','id_fakultas'=>'11', 'imei' => '352251063497309'],
        	['nama'=> 'Niken Sucitra','npm'=>'1406650153','id_fakultas'=>'11', 'imei' => '864223030611906'],

        	['nama'=> 'Niken Regina Hapsari','npm'=>'1506737672','id_fakultas'=>'12', 'imei' => '352251063497300'],
        	['nama'=> 'Virga Ghina Nisrina	','npm'=>'1506731126','id_fakultas'=>'12', 'imei' => '864223030611907'],

        	['nama'=> 'David Gayus El Harun','npm'=>'1506781484','id_fakultas'=>'13', 'imei' => '352251063497311'],
        	['nama'=> 'Devitri Anita Harun	','npm'=>'1506748360','id_fakultas'=>'13', 'imei' => '864223030611908'],

        	['nama'=> 'Nabila Sekartanti','npm'=>'1406545472','id_fakultas'=>'14', 'imei' => '352251063497312'],
        	['nama'=> 'Talitha Nabila','npm'=>'1406534664','id_fakultas'=>'14', 'imei' => '864223030611909'],

        	['nama'=> 'Nafsa Ghinaatha','npm'=>'1606890643','id_fakultas'=>'15', 'imei' => '352251063497313'],
        	['nama'=> 'Ghina Putri Wiyasti','npm'=>'1606892075','id_fakultas'=>'15', 'imei' => '864223030611900']
        ];
	
	    PenjagaTPS::insert($penjaga_TPS);
    }
}
