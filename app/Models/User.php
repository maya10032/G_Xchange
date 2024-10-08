<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * お気に入り
     */
    public function likeItems()
    {
        return $this->belongsToMany(Item::class, 'likes')->withTimestamps();
    }

    public function isLike($item_id)
    {
        return $this->likeItems()->where('items.id', $item_id)->exists();
    }

    /**
     * 購入履歴
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * カート
     */
    public function cartItems()
    {
        // withPivotメソッドを使って、countカラムを取得
        return $this->belongsToMany(Item::class, 'carts')->withPivot('count')->withTimestamps();
    }

    public function isCart($item_id)
    {
        return $this->cartItems()->where('items.id', $item_id)->exists();
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
