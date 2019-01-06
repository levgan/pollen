<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Response
 *
 * @package App
 * @property string $user
 * @property string $name
 * @property string $question
 * @property string $option
 * @property string $poll
*/
class Response extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'question_id', 'option_id', 'poll_id'];
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
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setOptionIdAttribute($input)
    {
        $this->attributes['option_id'] = $input ? $input : null;
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
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
    
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id')->withTrashed();
    }
    
    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id')->withTrashed();
    }
    
}
