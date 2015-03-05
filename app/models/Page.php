<?php

class Page extends Eloquent {
	protected $table = 'data';
        public static function saveFormData($data)
        {
            DB::table('data')->insert($data);
        }
}
