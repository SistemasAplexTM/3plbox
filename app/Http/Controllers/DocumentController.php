<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guide as Document;
use App\GuideState;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('templates.document');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Document::create($request->data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    Document::where('id', $id)->update($request->all());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Document::where('id', $id)->delete();
  }

  public function all()
  {
    $data = DB::table('guides AS a')
      ->leftjoin('type_guides AS b', 'a.type_guide_id', 'b.id')
      ->select(
        'a.id',
        'a.number',
        'a.shipping_date',
        'a.dex_date',
        'b.description AS type_guide',
        'a.type_guide_id',
        DB::raw('(
            SELECT
        			z.description AS state
        		FROM
        			guide_states AS x
        		INNER JOIN states AS z ON x.state_id = z.id
        		WHERE
        			x.guide_id = a.id
        		ORDER BY
        			x.id DESC
        		LIMIT 1
            ) AS state'),
        DB::raw('(
          		SELECT
          			z.color AS state_color
          		FROM
          			guide_states AS x
          		INNER JOIN states AS z ON x.state_id = z.id
          		WHERE
          			x.guide_id = a.id
          		ORDER BY
          			x.id DESC
          		LIMIT 1
          	) AS state_color')
      )
      ->orderBy('a.id', 'desc')
      ->get();
    return DataTables::of($data)->make(true);
  }

  public function crearEstado(Request $request)
  {
    if ($this->validarestado($request->pk, $request->value)) {
      return array('code' => 300);
    }

    GuideState::create([
      'guia_id' => $request->pk,
      'estado_id' => $request->value,
      'fecha' => $request->fecha,
      'observacion' => $request->observacion,
      'user_id' => Auth::id(),
    ]);
    return array('code' => 200);
  }

  public function updateEstado(Request $request)
  {
    GuideState::where([['guia_id', $request->pk], ['estado_id', $request->value]])->update([
      'guia_id' => $request->pk,
      'estado_id' => $request->value,
      'fecha' => $request->fecha,
      'observacion' => $request->observacion,
      'user_id' => Auth::id(),
    ]);
    return array('code' => 200);
  }

  public function rastreo()
  {
    return view('templates.rastreo');
  }

  public function destroy_estado($id, $estado)
  {
    DB::table('guia_estados')->where([['guia_id', $id], ['estado_id', $estado]])->delete();
  }

  public function rastrear($number)
  {
    $data = DB::table('estados AS a')
      ->leftjoin('guia_estados AS b', 'b.estado_id', 'a.id')
      ->leftjoin('guias AS c', 'b.guia_id', 'c.id')
      ->select(
        'a.id',
        'a.color',
        'a.descripcion',
        'c.number',
        'c.shipping_date',
        'c.dex_date',
        'c.type_guide_id',
        'b.fecha',
        'b.observacion',
        DB::raw("DATE_FORMAT(a.created_at,'%d - %m - %Y') AS fecha_creacion"),
        DB::raw('YEAR(a.created_at) as year_data, MONTH(a.created_at) as mont_data, DAY(a.created_at) as day_data')
      )
      ->where('c.number', $number)
      ->get();

    return array('code' => 200, 'data' => $data);
  }

  public function validarestado($guia, $estado)
  {
    $data = DB::table('guia_estados AS a')
      ->select(
        DB::raw('count(a.id) AS cantidad')
      )
      ->where([['a.guia_id', $guia], ['a.estado_id', $estado]])
      ->first();
    $result = false;
    if ($data->cantidad >= 1) {
      $result = true;
    }
    return $result;
  }
}
