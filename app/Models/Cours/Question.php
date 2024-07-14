<?php

namespace App\Models\Cours;

use App\Models\Cours\Corriger;
use App\Models\Cours\Exercice;
use App\Models\Cours\Evaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'point',
        'options',
        'evaluation_id',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }
    

    function evaluation():BelongsTo {
        return $this->belongsTo(Evaluation::class);
    }
    // La reponse traiter par l'utilisateur
    function corrigers():HasMany{
        return $this->hasMany(Corriger::class);
    }

    function exercices():BelongsToMany{
        return $this->belongsToMany(Exercice::class);
    }
    /********************************************************** */

    public static function type_question(Question $question):int{
        $type = 1;
        if (count($question->options)>1) { // est que qcm
            $nb_good=0;
            foreach ($question->options as $key => $value) {
                if(array_key_exists('is_correct',$value)){
                    if($question->options[$key]['is_correct'])
                        $nb_good++;
                }
            }
            $type = ($nb_good<=1) ? 1 : 2;
        } else { // un qestion ouverte
           $type = 3;
        }
        return $type;
    }

    private function _nb_good_response():int{
        $nb= 0;
        foreach ($this->options as $option) {
            if(array_key_exists('is_correct',$option)){
                $option['is_correct'] ? $nb++ : null;
            }
        }
        return $nb;
    }

    public function corrige_type_1(string|null $data):float{
        $point = 0;
        foreach ($this->options as $option) {
            if(array_key_exists('text',$option) and $option['text']==$data){
                $point = $this->point;
            }
        }
        return $point;
    }

    public function corrige_type_2(array $data):float{
        $point = 0;
        $nb_good_response=$this->_nb_good_response();
        if($nb_good_response==0 and count($data)==0){
            $point = $this->point;
        } elseif ($nb_good_response>0 and count($data)>0) {
            foreach ($data as $value) {
                $good = False;
                foreach ($this->options as $option) {
                    if(array_key_exists('text',$option) and array_key_exists('is_correct',$option)){
                        if($option['text']==$value and $option['is_correct']){
                            $good = True;
                        } 
                    }
                }

                if($good){
                    $point += $this->point/$nb_good_response;
                }else {
                    $point -= $this->point/$nb_good_response;
                }


                
            }
        }     
   
        return $point > 0 ? $point :0 ;
    }

    public function corrige_type_3(string|null $data):float{
        $point = 0;
        if(array_key_exists('text',$this->options[0])){
            if(trim(strtolower($this->options[0]['text']))==trim(strtolower($data))){
                $point += $this->point;
            }
        }

        return $point;
    }
}