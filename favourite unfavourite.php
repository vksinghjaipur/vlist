public function favourite(Request $request, $id)
    {
        $details=User::where('id',$id)->first();
        if($details->is_favourite==1){
            $data['is_favourite']="0";
            $msg="Unfavourite Client Successfully";
        } else{
            $data['is_favourite']="1";
            $msg="Favourite Clinet Added Successfully";
        }
        User::where('id',$id)->update($data);
        return back()->with('success', $msg);
    }