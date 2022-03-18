<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormField;  
use Illuminate\Support\Facades\DB;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $form = FormField::all();
        return view ('newform', compact('form'))->with('form', $form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveForm(Request $request)
    {
        
        // data from ajax request
        $field_data =json_decode($request->getContent(), true);

        $data=[];
        foreach($field_data as $key => $value){
            if(in_array($value['type'],["text","select","number"])){
                $data[] = $value;    
            }
        }

        // attempt data save
        $save_success = 1;

        DB::transaction(function () use ($data) {
         //   try {
                FormField::create([
                    'options' => json_encode($data),
                    'form_id' => '1'
                ]);
                    
           
        });
        return redirect('/form')->withSuccess('form data has been created');
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newForm()
    {
        return view('form');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $formField = FormField::find($id);
        return view('formview')->with('form', $formField);
                
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formField = FormField::find($id);
        return view('formedit')->with('form', $formField);
                
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FormField::destroy($id);
        return redirect('form')->withSuccess('form data has been deleted');
    }

      
}
