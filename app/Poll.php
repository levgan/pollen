<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Poll
 *
 * @package App
 * @property string $title
 * @property string $description
*/
class Poll extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];
    protected $hidden = [];
    
    
    
    public function question()
    {
        return $this->belongsToMany(Question::class, 'poll_question')->withTrashed();
    }
    
}
