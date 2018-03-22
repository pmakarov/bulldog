<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Area;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();

        return $areas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'features' => 'required',
        // ]);
        $save_count = 0;
        for ($i = 0; $i < count($request->input()["features"]); $i++) {
            $coordinate_array = [];
            foreach ($request->input()["features"][$i]["geometry"]["coordinates"][0] as $coordinates) {
                array_push($coordinate_array, new Point($coordinates[0], $coordinates[1]));
            }

            $linestring = new LineString($coordinate_array);
            
            $area = new Area();
            $area->name = 'Googleplex';
            $area->user_id = 1;
            $area->polygon = new Polygon([$linestring]);
            $area->save();
            $save_count++;
        }
        

        return response()->json([
            'status' => 'success',
            'message' => 'That was awesome! Added: ' . $save_count . ' areas to the database.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
