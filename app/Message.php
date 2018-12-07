<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message',
    ];


    /**
     * Возвращает TRUE, если письмо отправлено
     *
     * @return bool
     * @throws \Exception
     */
    public function send()
    {
        sleep(random_int(0, 3));
        return (bool)random_int(0, 1);
    }

}
