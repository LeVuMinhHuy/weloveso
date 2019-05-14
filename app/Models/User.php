<?php

namespace weloveso\Models;

use weloveso\Models\Status;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'username',
        'password',
        'password_confirmation',
        'location',
        'company',
        'first_name',
        'last_name',
        'avatar',
        'cover',
        'Introduce',
        'IntroImage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName(){
        if  ($this->first_name && $this->last_name){
            return "{$this->last_name} {$this->first_name}";
        }

        if($this->first_name){
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername(){
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUserName(){
        return $this->first_name ?: $this->username;
    }

    public function statuses(){
        return $this->hasMany('weloveso\Models\Status', 'user_id');
    }

    public function likes(){
      return $this->hasMany('weloveso\Models\Like', 'user_id');
    }

    public function getAvatarUrl(){
        if($this->avatar==null) { return "https://www.gravatar.com/avatar/{{ md5($this->username)}} ? d=mm&s=500";}
        //
        else return  $this->avatar;
    }
    public function getCoverUrl(){
        if($this->cover==null) { return "../images/cover.jpg";}
        //
        else return  $this->cover;
    }
    public function getIntro(){
        if($this->Introduce==null) { return "Chưa có gì cả, hãy gì đó đi";}
        //
        else return  $this->Introduce;
    }
    public function getIntroImage(){
        if($this->IntroImage==null) { return "../images/try_hard.jpg";}
        //
        else return  $this->IntroImage;
    }

    public function friendsOfMine(){
        return $this->belongstoMany('weloveso\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf(){
        return $this->belongstoMany('weloveso\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user){
        return $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user){
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
      return (bool) $status->likes
          ->where('likeable_id', $status->id)
          ->where('likeable_type', get_class($status))
          ->where('user_id', $this->id)
          ->count();
    }
}
