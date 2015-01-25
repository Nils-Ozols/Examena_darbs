<?php

class Comment extends Eloquent {

	protected $table = 'comments';
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function gallery() {
		return $this->belongsTo('Gallery');
	}

}
