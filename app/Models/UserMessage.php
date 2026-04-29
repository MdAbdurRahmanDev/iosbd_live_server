<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;
    private static $message;

    public static function add($request)
    {
        self::$message          = new UserMessage();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('user-images/'), $imageName);
            $imageUrl = 'user-images/'.$imageName;
            self::$message->image   = $imageUrl;
        }

        self::$message->name    = $request->name;
        self::$message->email   = $request->email;
        self::$message->subject = $request->subject;
        self::$message->purpose = $request->purpose;
        self::$message->message = $request->message;
        self::$message->save();
    }
}
