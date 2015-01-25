<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Gallery extends Eloquent {

	protected $table = 'galleries';
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function images() {
		return $this->hasMany('Image');
	} 
	
	public function comments() {
		return $this->hasMany('Comment');
	} 
	
	public function thumb() {
		if (!$this->hasMany('Image')->first())
			return '';
		return $this->hasMany('Image')->first()->image;
	}

}
