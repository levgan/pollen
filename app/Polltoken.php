<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Polltoken
 *
 * @package App
 * @property string $title
 * @property string $description
 * @property string $user
 * @property string $token
 * @property string $poll
*/
class Polltoken extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'token', 'user_id', 'poll_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPollIdAttribute($input)
    {
        $this->attributes['poll_id'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id')->withTrashed();
    }
    
}
