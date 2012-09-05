<?php

class User extends Aware {

    /**
    * Aware validation rules
    */
    public static $rules = array(
        'firstname' => 'required|min:2',
        'lastname' => 'required|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'image' => 'image|mimes:jpg,gif,png',
    );

    public static $imageSizes = array('big' => 100, 'small' => 50);

    /**
    * Attribute accessible for mass assignment
    * @var array
    */
    public static $accessible = array( 'firstname', 'lastname', 'email' );

    public function set_image($image){

        /* Generate file name */
        $fileName = Str::random(32) . '.' . File::extension($image['name']);

         /* Resize */
        Bundle::start('resizer');
        foreach(static::$imageSizes as $key => $size){
                Resizer::open( $image )
                ->resize( $size , $size , 'crop' )
                ->save( 'public/avatars/'.$size.'_'.$fileName, 100);
            }

        /* Remove old files */
        foreach(static::$imageSizes as $key => $size){
            $path = 'public/avatars/'.$this->image($key);
            if($this->image($key) != $size.'_default.gif' && File::exists($path)){
                File::delete($path);
            }
        }

        $this->set_attribute('image', $fileName);
    }

    public function get_image(){
        return $this->image();
    }

    public function image($size = 'big'){

        if(array_key_exists($size, static::$imageSizes)){

            if($this->get_attribute('image') && File::exists('public/avatars/'.static::$imageSizes[$size].'_'.$this->get_attribute('image'))){

                   return static::$imageSizes[$size].'_'.$this->get_attribute('image');
            }
            else static::$imageSizes[$size].'_default.gif';
        }

        return '100_default.gif';
    }

    /**
    * Action to perform before saving object on DB
    * *Hash password
    * @return boolean True
    */
    public function onSave()
    {
        /* if there's a new password, hash it */
        if($this->changed('password'))
        {
            $this->password = Hash::make($this->password);
        }

        return true;
    }

    public static $timestamps = true;

    public function roles()
    {
        return $this->has_many_and_belongs_to('Role', 'role_user');
    }

    public function has_role($key)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $key)
            {
                return true;
            }
        }

        return false;
    }

    public function has_any_role($keys)
    {
        if( ! is_array($keys))
        {
            $keys = func_get_args();
        }

        foreach($this->roles as $role)
        {
            if(in_array($role->name, $keys))
            {
                return true;
            }
        }

        return false;
    }
}
