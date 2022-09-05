<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index(){
        return view('listings.index',[
            'listing'=>Job::latest()->filter()->paginate(6)
        ]);
    }

    public function show(Job $job){
        return view('listings.show',[
            'listing'=>$job
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        $formFields= $request->validate([
            'title' => 'required|string',
            'tags' => 'required|string',
            'company' => ['required',Rule::unique('jobs','company')],
            'location' => 'required|string',
            'email' => ['required','email'],
            'website' => ['required','url'],
            'description' => 'required|string'
        ]);

        $formFields['user_id'] = auth()->id();
        
        if($request->hasFile('logo'))
        {
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        Job::create($formFields);

        return redirect('/')->with('message','Post created successfully');
    }

    public function edit(Job $job){
        return view('listings.edit',[
            'listing'=>$job
        ]);
    }

    public function update(Request $request,Job $job){

        if($job->user_id !=auth()->id()){
            abort(403,'Unauthorized Action!');
        }
        $formFields= $request->validate([
            'title' => 'required|string',
            'tags' => 'required|string',
            'company' => 'required',
            'location' => 'required|string',
            'email' => ['required','email'],
            'website' => ['required','url'],
            'description' => 'required|string'
        ]);
        
        if($request->hasFile('logo'))
        {
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        $job->update($formFields);

        return redirect('/jobs/'.$job->getKey())->with('message','Post updated successfully');
    }

    public function destroy(Job $job){
        if($job->user_id !=auth()->id()){
            abort(403,'Unauthorized Action!');
        }
        $job->delete();
        return redirect('/')->with('message','Post deleted succsuffly');
    }

    public function manage(){
        return view('listings.manage',[
            'listings'=>User::find(auth()->id())->jobs
        ]);
    }

}
