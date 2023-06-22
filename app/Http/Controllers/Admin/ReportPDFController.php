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
use App\Models\Horario;
use App\Models\Hora;
use App\Models\Asistencia;
use App\Models\Nota;

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

    public function impNominaMatricula($ciclo_seccion_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $nominaSeccion = Matricula::GetNominaCicloSeccion($ciclo_seccion_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'nominaSeccion' => $nominaSeccion,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.nomina-matricula', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('NOMINA_MATRICULA_'.$nominaSeccion->ciclo->year.'_'.$nominaSeccion->sigla.'.pdf');
    }

    public function impHorarioSeccion($ciclo_seccion_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $horarioSeccion = Horario::GetHorarioBySeccion($ciclo_seccion_id);
        $horas = Hora::where('borrado','0')->where('activo','1')->where('turno_id', $horarioSeccion->turno_id)->orderBy('horaini')->orderBy('horafin')->get();
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'horarioSeccion' => $horarioSeccion,
            'horas' => $horas,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.horario-seccion', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('HORARIO_SECCION_'.$horarioSeccion->ciclo->year.'_'.$horarioSeccion->sigla.'.pdf');
    }

    public function impAsistenciaSesion($ciclo_seccion_id, $fecha)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $horarioSeccion = Asistencia::GetAsistenciaSesionBySeccionAndFecha($ciclo_seccion_id, $fecha);
        $horas = Hora::where('borrado','0')->where('activo','1')->where('turno_id', $horarioSeccion->turno_id)->orderBy('horaini')->orderBy('horafin')->get();
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'horarioSeccion' => $horarioSeccion,
            'horas' => $horas,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.asistencia-sesion', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('HORARIO_ASISTENCIA_SESIONES_'.$horarioSeccion->ciclo->year.'_'.$horarioSeccion->sigla.'.pdf');
    }

    public function impFichaCalificacionesSeccion($ciclo_seccion_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $calificacionesSeccion = Nota::GetCalificacionesSeccion($ciclo_seccion_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'calificacionesSeccion' => $calificacionesSeccion,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.calificacion-seccion', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('CALIFICACION_SECCION_'.$calificacionesSeccion->ciclo->year.'_'.$calificacionesSeccion->seccion->sigla.'.pdf');
    }

    public function impFichaCalificacionesAlumno($matricula_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $calificacionesAlumno = Nota::GetCalificacionesAlumno($matricula_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'calificacionesAlumno' => $calificacionesAlumno,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.calificacion-alumno', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('CALIFICACION_ALUMNO_'.$calificacionesAlumno->ciclo->year.'_'.$calificacionesAlumno->matricula->id.'.pdf');
    }

    public function impFichaCalificacionesAlumnoCurso($matricula_id, $ciclo_curso_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $calificacionesAlumnoCurso = Nota::GetCalificacionesAlumnoCurso($matricula_id, $ciclo_curso_id);
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

  
        $data = [
            'calificacionesAlumnoCurso' => $calificacionesAlumnoCurso,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.calificacion-alumno-curso', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('CALIFICACION_ALUMNO_CURSO'.$calificacionesAlumnoCurso->ciclo->year.'_'.$calificacionesAlumnoCurso->matricula->id.'.pdf');
    }

    public function impAsistenciaSesionAlumno($ciclo_id, $fecha, $alumno_id)
    {

        //$matricula = Matricula::findOrFail($matricula_id);
        $alumno = Alumno::find($alumno_id);

        $horarioSeccion = Alumno::GetAsistencia($alumno_id, $ciclo_id, $fecha);
        $horas = Hora::where('borrado','0')->where('activo','1')->where('turno_id', $horarioSeccion->cicloSeccion->turno_id)->orderBy('horaini')->orderBy('horafin')->get();
        $institucionEductiva = InstitucionEducativa::where('borrado','0')
        ->where('activo','1')
        ->first();

        

  
        $data = [
            'horarioSeccion' => $horarioSeccion,
            'horas' => $horas,
            'date' => date('m/d/Y'),
            'institucionEductiva' => $institucionEductiva
        ]; 
            
        $pdf = PDF::loadView('reportspdf.asistencia-sesion-alumno', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('HORARIO_ASISTENCIA_ALUMNO_'.$horarioSeccion->ciclo->year.'_'.$horarioSeccion->cicloSeccion->sigla.'_'.$alumno->num_documento.'.pdf');
    }













    public function verPDF()
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $alumno_id = 1;
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

        return view('myPDF',compact('alumno','institucionEductiva'));
        
        //return $pdf->download('FICHA_MATRICULA_'.$cicloActivo->year.'_'.$alumno->num_documento.'.pdf');
    }

    public function descargarPDF()
    {

        //$matricula = Matricula::findOrFail($matricula_id);

        $alumno_id = 1;
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
            
        $pdf = PDF::loadView('myPDF', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('defaultFont', 'Arial'); 
        
        return $pdf->download('FICHA_MATRICULA_'.$cicloActivo->year.'_'.$alumno->num_documento.'.pdf');
    }
}
