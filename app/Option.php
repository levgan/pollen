<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Option
 *
 * @package App
 * @property string $title
 * @property string $description
 * @property string $value
*/
class Option extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'value'];
    protected $hidden = [];
    
    
    
    public function question()
    {
        return $this->belongsToMany(Question::class, 'option_question')->withTrashed();
    }
    
    public function questiontype()
    {
        return $this->belongsToMany(Questiontype::class, 'option_questiontype');
    }
    
}
