<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

use App\Models\CicloEscolar;
use App\Models\Matricula;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\Estado;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Niveles;
use App\Models\Grado;
use App\Models\CicloSeccion;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\Traslado;
use App\Models\Domicilio;

use App\Models\InstitucionEducativa;

use stdClass;
use DB;
use Storage;
use PDF;

use Illuminate\Support\Facades\Hash;

class ReportPDFController extends Controller
{

    public function impFichaMatricula($alumno_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $alumno = Alumno::GetById($alumno_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

        $cicloActivo = CicloEscolar::GetCicloActivo();
  
        $data = [
            'alumno' => $alumno,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.ficha-matricula', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('FICHA_MATRICULA_'.$cicloActivo->year.'_'.$alumno->num_documento.'.pdf');
    }

    public function verFichaMatricula($alumno_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $alumno = Alumno::GetById($alumno_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

        $cicloActivo = CicloEscolar::GetCicloActivo();
  
/*         $data = [
            'alumno' => $alumno,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.ficha-matricula', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial'); */

        return view('reportspdf.ficha-matricula',compact('alumno','institucionEductiva'));
        
        //return $pdf->download('FICHA_MATRICULA_'.$cicloActivo->year.'_'.$alumno->num_documento.'.pdf');
    }
}
