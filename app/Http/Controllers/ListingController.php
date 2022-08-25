<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listing

    public function index (){
        return view('listings.index',[
            'listings2' =>  Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //show single listing
    public function show (Listing $id){
        return view('listings.show',
        [
            'listing' => $id
        ]);
    }


    //show create form

    public function create(){
        return view('listings.create');
        
    }

    //Store Listing Data

    public function store(Request $request){
       $formFields= $request->validate([
         'name'=>'required',       
         'company'=>['required', Rule::unique('listings','company')],
         'location' => 'required',
         'website' => ['required'],
         'email' => ['required','email'],
         'tags' => 'required',
         'desc' =>'required' 
       ]);

       if($request->hasFile('logo')){
        $formFields['logo']= $request->file('logo')->store('logos','public');
       }

       $formFields['user_id']= auth()->id();

      
    
       Listing::create($formFields);
       return redirect('/')->with('message','Crée avec succès !'); 
    }


    //show edit or modiication

    public function edit(Listing $id){
        return view('listings.edit',['listing' => $id]);
    }

    //update  listing after edit
    public function update(Request $request, Listing $id){
        
        //Make sure logged user is owner

        if($id->user_id != auth()->id()){
            abort('403','Vous n\'etes pas autorisé à le modifier');
        }

        $formFields= $request->validate([
          'name'=>'required',
          'company'=>['required'],
          'location' => 'required',
          'website' => ['required'],
          'email' => ['required','email'],
          'tags' => 'required',
          'desc' =>'required' 
        ]);
        if($request->hasFile('logo')){
         $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $id->update($formFields);
       return back()->with('message','Mis à jour!'); 
    }


    //Delete listing

    public function destroy(Listing $id) {

         //Make sure logged user is owner

         if($id->user_id != auth()->id()){
            abort('403','Vous n\'etes pas autorisé à le modifier');
        }
        
        $id->delete();
        // return redirect('/')->with('message', 'Supprimé avec succès');
        return back()->with('message', 'Supprimé avec succès');
    }

    //Manage Listings

    public function manage(){
        return  view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
    }
   
