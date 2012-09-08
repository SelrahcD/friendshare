<?php

class User extends Aware {

    public static $timestamps = true;

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

    /**********************************************************
     * Image
     *********************************************************/

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
            else {
                return static::$imageSizes[$size].'_default.gif';
            }
        }

        return '100_default.gif';
    }
    
    /**********************************************************
     * Friends
     *********************************************************/
    public function friends(){
        return $this->has_many_and_belongs_to('User', 'users_users', 'friend_id')->with('debt');
    }

    public function isFriendWith($user){
        $id = 0;
        if($user instanceof User){
            $id = $user->id;
        }
        elseif(is_int($user)){
            $id = $user;
        }
        else {
            throw new UnvalidArgumentException('user must be an int or a user');
        }

        return DB::table('users_users')->where('user_id', '=', $this->id)->where('friend_id', '=', $id)->count();
    }

    public function sharedFriendsWith($user){
        $id = 0;
        if($user instanceof User){
            $id = $user->id;
        }
        elseif(is_int($user)){
            $id = $user;
        }
        else {
            throw new UnvalidArgumentException('user must be an int or a user');
        }

        // User::query()->join('users_users as u1', 'user_id', '=', 'u1.friend_')
        $res = DB::table('users_users as u1')->join('users_users as u2', 'u1.friend_id', '=', 'u2.friend_id')->select(array('u2.friend_id as u2f', 'u1.friend_id as u1f', 'u1.user_id as u1u','u2.user_id as u2u'))->where('u2.user_id', '=', $id)->where('u1.user_id', '=', $this->id)->get();
            // . ' AND WHERE `u2.user_id` = '. $id);
        //select('friend_id')->where('user_id', '=', $this->id)->where_in('friend_id', array(3))
        //
        return User::query()->join('users_users as u1', 'users.id', '=', 'u1.friend_id')->join('users_users as u2', 'u1.friend_id', '=', 'u2.friend_id')->where('u2.user_id', '=', $id)->where('u1.user_id', '=', $this->id)->get();
    }


    /**********************************************************
     * Role
     *********************************************************/
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

    /**********************************************************
     * Aware
     *********************************************************/

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
}
