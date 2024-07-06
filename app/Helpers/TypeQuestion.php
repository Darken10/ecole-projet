<?php

namespace App\Helpers;

class TypeQuestion{

    public static function typeQuestion(array $question){
        $nombre_good_response=0;
        $isQCM = False;
        if(count($question['options'])>=2){
            $isQCM = True;
            foreach ($question['options'] as $option) {
                if($option['is_correct']==True){
                    $nombre_good_response++;
                }
            }
        }
        elseif(count($question['options'])==1){
            $isQCM = False;
            $nombre_good_response =($question['options'][0]['is_correct']) ? 1 : 0 ;
        }

        /********** */
        if ($nombre_good_response == 1 and $isQCM) {
            return 1; // QCM-SIMPLE
        } elseif ($nombre_good_response > 1 and $isQCM) {
            return 2; // QCM-Multiple
        } 
        elseif ($nombre_good_response == 1 and !$isQCM) {
            return 3; // Question ouverte
        } 
        else {
           return null;
        }
        
    }

    public static function isQcmSimple(array $question):bool{
        return TypeQuestion::typeQuestion($question)==1;
    }

    public static function isQcmMultiple(array $question):bool{
        return TypeQuestion::typeQuestion($question)==2;
    }

    public static function isQuestionOuverte(array $question):bool{
        return TypeQuestion::typeQuestion($question)==3;

    }
}