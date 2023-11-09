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
            ->orderBy('id')
            ->paginate(12);

            if (!$projects) {
                abort(404, 'Projects not found');
            }    
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

            if (!$project) {
                abort(404, 'Project not found');
            }

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

    public function portfolioByType($type_id)
    {   
        $projects = Project::select('id','type_id','name','slug','description')
            ->with('technologies:id,colour,label','type:id,colour,name')
            ->where('type_id', $type_id)
            ->orderBy('id')
            ->paginate(12);

       return response()->json($projects);
    }
}