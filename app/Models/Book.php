<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function Author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function Publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }

    public function Shelf()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function Age()
    {
        return $this->belongsTo('App\Models\Age');
    }

    public function Reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    
    public function Checkout(User $user)
    {
        $this->Reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now()
        ]);
    }

    public function Checkin(User $user)
    {
        $reservation = $this->Reservations()->where('User_id',$user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();

        if(is_null($reservation))
        {
            throw new \Exception();
        }
        
        $reservation -> update([
            'checked_in_at' => now(), 
        ]);
    }
}
