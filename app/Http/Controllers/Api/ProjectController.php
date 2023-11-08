<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('id','type_id','name','slug','description')
            ->with('technologies:id,colour,label','type:id,colour,name')
            ->paginate(12);

        // foreach ($projects as $project) {
            // $project->description = $project->getAbstract(200);
            // if there was a cover image
            // $project->cover_image = $project->getAbsUriImage();
        // }

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::select('id','type_id','name','slug','description')
            ->with('technologies:id,colour,label','type:id,colour,name')
            ->where('slug', $slug)
            ->first();

            // if there was a cover image  
            // $project->cover_image = $project->getAbsUriImage();

        return response()->json($project);
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

    public function projectsByType($type_id)
    {   
        $type = Type::select('id','colour','name')
            ->where('id', $type_id)
            ->first();

        if (!$type) {
            abort(404, 'Type not found');
        }

        $projects = Project::select('id','type_id','name','slug','description')
            ->with('technologies:id,colour,label','type:id,colour,name')
            ->where('type', $type_id)
            ->paginate(12);

        return response()->json($projects, $type);
    }
}