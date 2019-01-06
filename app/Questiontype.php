<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Questiontype
 *
 * @package App
 * @property string $title
 * @property string $description
*/
class Questiontype extends Model
{
    protected $fillable = ['title', 'description'];
    protected $hidden = [];
    
    
    
    public function option()
    {
        return $this->belongsToMany(Option::class, 'option_questiontype')->withTrashed();
    }
    
}
