<?php

namespace App\Models\Cours\Partie;

use App\Models\User;
use App\Models\Statut;
use App\Models\Matiere;
use App\Models\Cours\Evaluation;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Content;
use App\Models\Cours\Partie\Chapitre;
use App\Models\Cours\Partie\Objectif;
use App\Models\Cours\Partie\BigLetter;
use App\Models\Cours\Partie\BigNumber;
use App\Models\Cours\Partie\PreRequie;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cours\Partie\UserQuestion;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'chapitre_id',
        'user_id',
        'statut_id',
        'lesson_numero',
        'image_uri',
        'published_at',
        'description'
    ];

    function chapitre(): BelongsTo|null
    {
        return $this->belongsTo(Chapitre::class);
    }

    /*function matiere(): BelongsTo|null
    {
        return $this->belongsTo(Matiere::class);
    }*/

    function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }


    function pre_requies(): HasMany
    {
        return $this->hasMany(PreRequie::class);
    }

    function objectifs(): HasMany
    {
        return $this->hasMany(Objectif::class);
    }

    function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function prof()
    {
        return $this->user();
    }

    function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot(['apreciation', 'is_view', 'is_learned', 'created_at', 'updated_at']);
    }

    function eleves(): BelongsToMany
    {
        return $this->users();
    }

    static function all_lessons():Collection{
        return Lesson::query()->where('user_id',auth()->user()->id)->get();
    }

    function user_questions():HasMany{
        return $this->hasMany(UserQuestion::class);
    }

    /************************************************************************************* */

    public function is_published(): bool
    {
        return $this->published_at < now();
    }

    public function addView(){
        $this->nb_views += 1;
        $this->save();
        return $this;
    }

    public function addFollower(){
        if (!$this->users()->where('user_id',auth()->user()->id)->exists())
            return $this->users()->attach(auth()->user()->id,['apreciation'=>0, 'is_view'=>True, 'is_learned'=>True,'is_like'=>false,'niveau_evolution'=>0]);
        $pivot = $this->users()->where('user_id',auth()->user()->id)->get()->last()->pivot;
        $pivot->is_learned=1;
        $this->save();
        $pivot->save();
        return  True;

    }

    public function addApreciation($appreciation){
        if (!$this->users()->where('user_id',auth()->user()->id)->exists())
            return $this->users()->attach(auth()->user()->id,['apreciation'=>0, 'is_view'=>True, 'is_learned'=>True,'is_like'=>false]);
        $this->users()->where('user_id',auth()->user()->id)->pivot->apreciation=$appreciation;
        $this->save();
        $this->users()->where('user_id',auth()->user()->id)->pivot->save();
        return  True;

    }

    public function count_views():int {
        return $this->nb_views;
    }

    public function count_likes():int{
        
        return count($this->users()->wherePivot('is_like',true)->get());
    }

    public function count_followers():int{
        
        return count($this->users()->wherePivot('is_learned',true)->get());
    }

    public function apreciation():float{
        $all_apreciation = $this->users()->wherePivot('apreciation','>',0)->withPivot('apreciation')->get();
        $n = 0;
        foreach ($all_apreciation as  $value) {
            $n += $value->pivot->apreciation;
        }
        return count($all_apreciation)>0 ? $n/count($all_apreciation) : 0;
    }

    public function niveau_evolution(){
        dd($this->users()->withPivot(['niveau_evolution'])->where('user_id',auth()->user()->id)->get()->last());
    }

    public function passe_niveau(Content $content){
        
        //$this->
    }

}
