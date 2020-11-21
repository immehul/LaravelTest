<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\User;

class UserConnectionRequest extends Model
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_conn_request';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'req_user_id', 'status',
    ];

    /**
     * Get the list of my connection
     *
     * @var array
     */
    public function getMyConnectionList(){
        return $this->belongsTo(User::class, 'req_user_id');
    }
}
