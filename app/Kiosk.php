<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kiosk extends Model
{
    protected $fillable = [
        'queue_number',
        'date',
        'status',
        'registration_number',
        'type',
        'locket'
    ];
    protected $appends = ['sound'];

    function getSoundAttribute() {
        if($this->status == 'open'){
            $number = null;
            $type_sound = null;
            switch ($this->queue_number){
                case '0':
                    $number = 'sounds/0.mp3';
                    break;
                case '1':
                    $number = 'sounds/1.mp3';
                    break;
                case '2':
                    $number = 'sounds/2.mp3';
                    break;
                case '3':
                    $number = 'sounds/3.mp3';
                    break;
                case '4':
                    $number = 'sounds/4.mp3';
                    break;
                case '5':
                    $number = 'sounds/5.mp3';
                    break;
                case '6':
                    $number = 'sounds/6.mp3';
                    break;
                case '7':
                    $number = 'sounds/7.mp3';
                    break;
                case '8':
                    $number = 'sounds/8.mp3';
                    break;
                case '9':
                    $number = 'sounds/9.mp3';
                    break;
            }
            switch ($this->type){
                case 'bpjs':
                    $type_sound =  'sounds/c1.mp3';
                    break;
                case 'non-bpjs':
                    $type_sound =  'sounds/c2.mp3';
                    break;
                case 'mcu':
                    $type_sound =  'sounds/c3.mp3';
                    break;
                case 'poli-umum':
                    $type_sound =  'sounds/c4.mp3';
                    break;
                case 'cito':
                    $type_sound =  'sounds/c5.mp3';
                    break;
            }

            $first_file = file_get_contents('sounds/c-no-antrian.mp3');
            $second_file = file_get_contents($number);
            $third_file = file_get_contents($type_sound);

            file_put_contents('sounds/temp/'.$this->queue_number.'_'.$this->type.'.mp3',$first_file . $second_file .$third_file);

            return 'sounds/temp/'.$this->queue_number.'_'.$this->type.'.mp3';
        }
        return '-';
    }


}
