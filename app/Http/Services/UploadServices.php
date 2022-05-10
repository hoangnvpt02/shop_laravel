<?php

namespace App\Http\Services;

use Validator;

class UploadServices
{
    public function store($request) {


        if($request->hasFile('file')) {
            try {
                $validator = Validator::make($request->all(),[
                    'file' => 'mimes:jpeg,jpg,png,gif|required'
                ]);

                if($validator->fails()){
                    throw new Exception('Not image');
                }

                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'uploads/' . date("Y/m/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}
