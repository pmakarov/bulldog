<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\Area;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use App\MachineLearningModel;

class TaskController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('geometries:id,name,polygon', 'machine_learning_models:id,name,object,algorithm_id')->orderBy('created_at', 'desc')
        ->get(['id', 'name', 'user_id', 'status', 'start_date', 'end_date'])->where('user_id', Auth::user()->id);

        return $tasks;
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
        //return $request->input("areas");
        $this->validate($request, [
            'name' =>'required|max:100',
            'start_date' => 'required',
            'status' => 'required'
        ]);

        $areas = [];
        if ($request->input("areas")) {
            $areas = $this->parseAreas($request->input("areas"));
        }

        $models = [];
        if ($request->input("models")) {
            $models = $this->parseModels($request->input("models"));
        }

        try {
            $task = new Task();
            $task->user_id = Auth::user()->id;
            $task->name = $request->input("name");
            $task->status = $request->input("status");
            $task->start_date = $request->input("start_date");
            $task->end_date = $request->input("end_date");
            $task->save();
    
            $task->geometries()->saveMany($areas);
            $task->machine_learning_models()->saveMany($models);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
        

        return response()->json([
            'status' => 'success',
            'message' => 'That was awesome! Added task to the database.'
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
        //$task = Task::findOrFail($id);
        $task = Task::with('geometries:id,name,polygon', 'machine_learning_models:id,name,object,algorithm_id')
        ->findOrFail($id);
        //->get(['id', 'name', 'user_id', 'status', 'start_date', 'end_date']);
        
        return $task;
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

    public function parseAreas($features)
    {
        $area_array = [];
        for ($i = 0; $i < count($features); $i++) {
            $coordinate_array = [];
            foreach ($features[$i]["geometry"]["coordinates"][0] as $coordinates) {
                array_push($coordinate_array, new Point($coordinates[0], $coordinates[1]));
            }

            $linestring = new LineString($coordinate_array);
            
            $area = new Area();
            $area->name = 'HoneyBadger';
            $area->user_id = Auth::user()->id;
            $area->polygon = new Polygon([$linestring]);
            
            array_push($area_array, $area);
        }

        return $area_array;
    }

    public function parseModels($models)
    {
        $model_array = [];
        for ($i = 0; $i < count($models["models"]); $i++) {
            $model = new MachineLearningModel();
            $model->name = $models["models"][$i]["name"];
            $model->object = $models["models"][$i]["object"];
            $model->algorithm_id = $models["models"][$i]["algorithm"];

            array_push($model_array, $model);
        }

        return $model_array;
    }
}
