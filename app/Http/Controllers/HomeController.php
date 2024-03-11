<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\FlareClient\View;

class HomeController extends Controller
{
    public function index(){
        return View("Index.index");
    }

    public function verificarLogin(Request $request){

        $request =  request()->only("email","password");
        if(Auth::attempt($request)){
            request()->session()->regenerate();
            //return "logeado correctamente";
            return redirect()->route("paginaPrincipal");
        }else{
            session()->flash("errorLogueo","Correo o contraseña incorrecto");
            return redirect()->route("index");
        }
    }


    public function paginaPrincipal(Request $request){

        //return $request;

        $estados = Estado::all();
        $diaSemana = date('N');
        $diaActual = date("d"); // Obtiene el día actual

        //Para obtener la hora actual de Costa Rica
        date_default_timezone_set('America/Costa_Rica'); // Configura la zona horaria a Costa Rica
        $fechaActual = new DateTime(); // Crea un objeto DateTime con la fecha y hora actual en la zona horaria de Costa Rica
        $horaActual = $fechaActual->format('H:i'); // Obtiene la hora actual en formato 'HH:mm:ss' en la zona horaria de Costa Rica

        //return $diaSemana;
        
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
                    }
                    else if($diaActual == "5" && $item->estado == -1 || $diaActual == "20" && $item->estado == -1 && $item2->id == $item->idFK){
                        $item->estado = -1;
                        $item->save();
                    }else if($diaActual == "6" && $item->estado == 1 || $diaActual == "21" && $item->estado == 1 && $item2->id == $item->idFK){
                        if($horaActual >= "01:00" && $horaActual <= "20:00"){
                            $item->estado = 0;
                            $item->save();
                        }
                    }
                }
            }
        }





            $sumaAcobrar = Usuario::sum("saldoRebajado");
            $clientes = DB::table('usuarios')->count();

            $txtBuscar = $request->input('txtBuscar');
            $usuarios = Usuario::where('nombre', 'LIKE', '%'.$txtBuscar.'%')->orderBy('nombre', 'asc')->get();

            //$usuarios = Usuario::all();
            return view("PaginaPrincipal.paginaPrincipal",compact("usuarios","txtBuscar","sumaAcobrar","clientes","diaSemana","diaActual","horaActual"));

        
    
    }

    
    public function deslogueo(Request $request){
        Auth::logout();

        $request->session()->invalidate(); //invalida la sesion del usuario 
        $request->session()->regenerateToken(); // regenera el token

        return redirect()->route("index");
    }
}
