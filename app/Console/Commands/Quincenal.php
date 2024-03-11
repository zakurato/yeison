<?php

namespace App\Console\Commands;

use App\Models\Estado;
use App\Models\Usuario;
use DateTime;
use Illuminate\Console\Command;

class Quincenal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:quincenal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
                //comando para que se ejecute para siempre esto se debe pegar donde uno hace el pull en EC2
        //nohup php artisan schedule:work > /dev/null 2>&1 &
        //comando para detener ese comando schedule:work
        //ps aux | grep "php artisan schedule:work"
        //me tira un pid un numero y debo escribirlo aqui como este ejemplo
        //kill 12345

        //$texto = "hola";
       //Storage::append("archivo.txt",$texto);
        
       $estados = Estado::all();
       $diaSemana = date('N');
       $diaActual = date("d"); // Obtiene el día actual


       //Para obtener la hora actual de Costa Rica
       date_default_timezone_set('America/Costa_Rica'); // Configura la zona horaria a Costa Rica
       $fechaActual = new DateTime(); // Crea un objeto DateTime con la fecha y hora actual en la zona horaria de Nueva York
       $horaActual = $fechaActual->format('H:i'); // Obtiene la hora actual en formato 'HH:mm:ss' en la zona horaria de Nueva York


       //si el dia de la semana es miercoles pasar todos los estados "1" a color negro o estado "0"
       //si el dia de la semana es miercoles pasar todos los estados "0" a "-1"
       //si el dia de la semana es miercoles los estados "-1" quedan en "-1"
       $todosUsuarios = Usuario::all();
       foreach($todosUsuarios as $item2){
           if($item2->metodoPago == "Semanal"){
               foreach($estados as $item){
                   if($diaSemana == "3" && $item->estado == 0 && $item2->id == $item->idFK){
                       $item->estado = -1;
                       $item->save();
                       break;
                   }
                   else if($diaSemana == "3" && $item->estado == -1 && $item2->id == $item->idFK){
                       $item->estado = -1;
                       $item->save();
                       break;
                   }else if($diaSemana == "4" && $item->estado == 1 && $item2->id == $item->idFK){
                       if($horaActual >= "01:00" && $horaActual <= "20:00"){
                           $item->estado = 0;
                           $item->save();
                           break;
                       }
                   }
               }
           }
       }
           
           
       foreach($todosUsuarios as $item2){
            if($item2->metodoPago == "Quincenal"){
               foreach($estados as $item){
                   if($diaActual == "5" && $item->estado == 0 || $diaActual == "20" && $item->estado == 0 && $item2->id == $item->idFK){
                       $item->estado = -1;
                       $item->save();
                       break;
                   }
                   else if($diaActual == "5" && $item->estado == -1 || $diaActual == "20" && $item->estado == -1 && $item2->id == $item->idFK){
                       $item->estado = -1;
                       $item->save();
                       break;
                   }else if($diaActual == "6" && $item->estado == 1 || $diaActual == "21" && $item->estado == 1 && $item2->id == $item->idFK){
                       if($horaActual >= "01:00" && $horaActual <= "20:00"){
                           $item->estado = 0;
                           $item->save();
                           break;
                       }
                   }
               }
           }
       }
    }
}
