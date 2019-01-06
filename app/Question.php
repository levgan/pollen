<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 *
 * @package App
 * @property string $title
 * @property string $description
*/
class Question extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];
    protected $hidden = [];
    
    
    
    public function questiontype()
    {
        return $this->belongsToMany(Questiontype::class, 'question_questiontype');
    }
    
    public function option()
    {
        return $this->belongsToMany(Option::class, 'option_question')->withTrashed();
    }
    
    public function poll()
    {
        return $this->belongsToMany(Poll::class, 'poll_question')->withTrashed();
    }
    
}
