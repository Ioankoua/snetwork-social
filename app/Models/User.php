<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'city',
        'birth',
        'email',
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Получает имя фамилию или только имя
    public function getName()
    {
        if ($this->name && $this->surname)
        {
            return "{$this->name} {$this->surname}";
        }

        if ($this->name) 
        {
            return $this->name;
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    // Получить аватарку из gavatar
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email)?d=robohash&s=100 }}";
    }

    public function getAvatarUrlMain()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email)?d=robohash&s=300 }}";
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\Status', 'user_id');
    }

    // Отношение многи ко многим, мои друзья
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'frends', 'user_id', 'frend_id');
    }

    // Отношенеи многи ко многим, один друг
    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'frends', 'frend_id', 'user_id');
    }

    // Подтверджение заявки в друзья
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get() );
    }

    # запросы в друзья
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    # запрос на ожидание друга
    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    # есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    # получил запрос о дружбе
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    # добавить друга
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    # удалить из друзей
    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    # принять запрос на дружбу
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    # пользователь уже в друзьях
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    //Получаем id отправителя
    public function isMessage()
    {
        return $this->belongsToMany('App\Models\Messages', 'message', 'sender_user_id', 'getter_user_id');
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes
                ->where('likeable_id', $status->id)
                ->where('likeable_type', get_class($status))
                ->where('user_id', $this->id)
                ->count();
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }

    public function getAvatarPath($user_id)
    {
        $path = "uploads/avatars/id{$user_id}";

        if (!file_exists($path) ) mkdir($path, 0777, true);
        
        return "/$path/";
    }

    public function clearAvatars($user_id)
    {
        $path = "uploads/avatars/id{$user_id}";

        if (file_exists(public_path("/$path") ) ) {
            foreach (glob(public_path("/$path/*") ) as $avatar ) {
                unlink($avatar);
            }
        }
    }


}
