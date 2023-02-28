<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    protected $validationRules = [
        'title' => ['required', 'unique:projects' ],
        'project_date' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:1024' // Max file size 1 MB
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create', ["project" => new Project()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);
        //$data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($data['title']);
        $data['image'] =  Storage::put('uploads', $data['image']);
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', [ 'project' => $project] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', Rule::unique('projects')->ignore($project->id) ],
            'project_date' => 'required',
            'content' => 'required',
            'image' => 'required|image|max:1024' // Max file size 1 MB
        ]);
        
        
        if ($request->hasFile('image')){
            
            if (!$project->isImageAUrl()){
                Storage::delete($project->image);
            }
            
            $data['image'] =  Storage::put('uploads', $data['image']);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd($project);
        if (!$project->isImageAUrl()) {
            Storage::delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
