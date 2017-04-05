<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Website;
use App\Image;

use Illuminate\Support\Facades\Input;

class AppController extends Controller
{
    public function index(Request $request, User $user)
    {
      $user->update(['notes' => $request->notes ]);
      $user->update(['tbd'  => $request->tbd ]);

      if($request->has('websites'))
      {
        $originals = $user->websites()->get()->all();
        $websites  = $request->websites;

        $new       = array_slice($websites, -4, 4);
        $old       = array_slice($websites,  0, count($websites) - 4);

        for($i = 0; $i < count($originals); $i++)
        {
          if(empty($old[$i]))
          {
            Website::where('id', '=', $originals[$i]->id)->delete();
          }

          else if($originals[$i]->website != $old[$i])
          {
            Website::where('id', '=', $originals[$i]->id)->update(['website', $old[$i]]);
          }
        }

        foreach($new as $website)
        {
          if(!empty($website))
          {
            Website::create([ 'user_id' => $user-> id, 'website' => $website ]);
          }
        }
      }

      if($request->hasFile('image'))
      {

        $path      = public_path('uploadedimages/' . $user->email);
        $image     = $request->file('image');
        $extension = $image->extension();
        $filename  = $image->getClientOriginalName();

        $exists    = Image::where([['image', '=', $filename], ['user_id', '=', $user->id]])->first();

        if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'gif')
        {
          $errors = "File is not either jpg or gif";
          return view('errors')->with(compact('errors'));
        }

        if(is_null($exists))
        {
          Image::create(['user_id' => $user->id, 'image' => $image->getClientOriginalName() ]);
        }
        else
        {
          Image::create(['user_id' => $user->id, 'image' => rand(11111,99999) . $image->getClientOriginalName() ]);
        }

        $image->move($path, $image->getClientOriginalName());
      }

      if($request->has('delete'))
      {
        $deletes = $request->delete;

        foreach($deletes as $delete)
        {
          Image::where('id', '=', $delete)->delete();
        }
      }

      $user->save();
      return back()->with(compact('user'));
    }
}
