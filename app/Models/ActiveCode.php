<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expired_at'
    ];

    public $timestamps = false; 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query , $user){
        //moghe estfade az in method niazi nis parametr 1 ro yni query ro bdim va laravel bsort otomat mide va ma az parametr 2 bayd bhsh bdim
        
        if($code = $this->getAliveCodeForUser($user)){
            $code = $code->code;
        }else{
            do{
                $code = mt_rand(100000 , 999999);
            }while($this->checkCodeIsUnique($user , $code));

            $user->activeCode()->create([
                'code' => $code ,
                'expired_at' => now()->addMinutes(env('SMS_CODE_LIFETIME'))
            ]);
        }
        
        return $code;
    }

    public function checkCodeIsUnique($user , int $code){
        return !! $user->activeCode()->whereCode($code)->first();
        // operation !! mige age samt rast ye object bod true va age nbod false ro return kon
        //whereCode($code)   hmon where('code' , $code) hastesh yani mishe esm field ro ghabl prantz nvsht
    }

    private function getAliveCodeForUser($user){
        return $user->activeCode()->where('expired_at' , '>' , now())->first();
    }

    public function scopeverifyCode($query , $code , $user){  
        return !! $user->activeCode()->whereCode($code)->where('expired_at' , '>' , now())->first();
    }
}
