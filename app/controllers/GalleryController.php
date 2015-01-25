<?php

class GalleryController extends BaseController {
    
    
	public function getAdd() {
		return $this->getEdit();
	}
	
	public function getEdit($id = 0) {
		$gallery = Gallery::find($id);
		if (!$gallery) {
			$gallery = new Gallery();
			if (Auth::guest()) {
				return Redirect::to('');
			}
		} else {
			if (Auth::id() != $gallery->user_id && !Auth::user()->isAdmin()) {
				return Redirect::to('');
			}
		}
		
		$images = $gallery->images();
		
		return View::make('gallery_form', array('gallery' => $gallery, 'images' => $images));
	}
  	
	public function postAdd() {
		return $this->postEdit();
	}
	
	public function postEdit($id = 0) {
		$gallery = Gallery::find($id);
		if (!$gallery) {
			$gallery = new Gallery();
			if (Auth::guest()) {
				return Redirect::to('');
			}
		} else {
			if (Auth::id() != $gallery->user_id && !Auth::user()->isAdmin()) {
				return Redirect::to('');
			}
		}
		
		$images = $gallery->images();
		
		$data = Input::all();
		
		$rules = array('name' => 'required');
		$validator = Validator::make($data, $rules);
		if ($validator->passes()) {
			$gallery->name=$data['name'];
			$gallery->description = $data['description'];
			$gallery->user_id = Auth::id();
			if (isset($data['public'])) $gallery->public = 1;
			$gallery->save();
			
			Image::where('gallery_id','=',$gallery->id)->delete();
			
			foreach(isset($data['image']) ? $data['image'] : array() as $i => $v) {
				$image = new Image();
				$image->gallery_id = $gallery->id;
				$image->image = $v;
				$image->description = $data['imgdescr'][$i];
				$image->save();
			}
			return  Redirect::to('user');
		}
		
		return View::make('gallery_form', array('gallery' => $gallery, 'images' => $images))->withErrors($validator);
	}
	
	public function postAddimages() {
		if (Auth::guest()) return '';
		
		if (!is_dir(public_path('galleryimages'))) {
            mkdir(public_path('galleryimages'));
        }
        if (!is_dir(public_path('galleryimages/'.Auth::id()))) {
            mkdir(public_path('galleryimages/'.Auth::id()));
        }
		
		$data = array();
        
        foreach(Input::file() as $file) {
            if ($file->isValid()) {
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $destinationPath = public_path('galleryimages/'.Auth::id());
                if ( in_array( strtolower($extension), array('png', 'gif', 'jpg', 'jpeg') ) ) {
                    $file->move($destinationPath, $name);
                    
                    $data[] = asset('/galleryimages/'.Auth::id().'/'.$name);
                }
            }
        }
		
		return json_encode($data);
	}
	
	public function getView($id) {
		$gallery = Gallery::find($id);
		
		if (!$gallery or ($gallery->user_id != Auth::id() and !$gallery->public)) {
			return Redirect::to('');
		}
		
		$images = $gallery->images()->get();
		
		$comments = $gallery->comments()->get();
		
		return View::make('gallery',array('gallery' => $gallery, 'images' => $images, 'comments' => $comments));
	}
	
	public function postView($id) {
		$gallery = Gallery::find($id);
		if (!$gallery or ($gallery->user_id != Auth::id() and !$gallery->public) or Auth::guest()) {
			return Redirect::to('');
		}
		$comment = new Comment();
		$comment->comment = Input::get('comment');
		$comment->user_id = Auth::id();
		$comment->gallery_id = $id;
		$comment->save();
		
		return $this->getView($id);
	}

}

?>