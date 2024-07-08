<?php

namespace App\Livewire\Cours;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Cours\Partie\Content;

class Section extends Component
{

    public Content $content;
    public Collection $all_contents;
    public array $ids_section ;
    public int $id ;
    public int $number_section_finished = 0 ;
    public bool $has_prev=false;
    public bool $has_next=false;


    function mount(Content $content){
        $this->content = $content;
        $this->ids_section = [];
        $this->all_contents = Content::query()
        ->where('lesson_id',$content->lesson->id)->orderBy('numero_section')->get();
        $this->number_section_finished = 1;
        foreach ($this->all_contents as $content) {
            $this->ids_section[] = $content->id; 
        }
        $this->id = $this->content->id;
        
    }

    function next(){
        if(count($this->all_contents) > 1){
            foreach ($this->ids_section as $key => $value) {
                if($value == $this->id){
                    if(array_key_exists($key+1,$this->ids_section)){
                        $this->id = $this->ids_section[$key+1];
                        $this->content = Content::findOrFail($this->id);
                        $this->number_section_finished +=1; 
                        $this->register_section_users();
                        break;
                    }
                }
            }
        }
    }

    function prev(){
        if(count($this->all_contents) > 1){
            foreach ($this->ids_section as $key => $value) {
                if($value == $this->id){
                    if(array_key_exists($key-1,$this->ids_section)){
                        $this->id = $this->ids_section[$key-1];
                        $this->content = Content::findOrFail($this->id);
                        $this->number_section_finished -=1;
                        break;
                    }
                }
            }
        }
    }

    function has_prev_or_next(){
        if(count($this->all_contents) > 1){
            foreach ($this->ids_section as $key => $value) {
                if($value == $this->id){
                    $this->has_prev = array_key_exists($key-1,$this->ids_section) ? True : False;
                    $this->has_next = array_key_exists($key+1,$this->ids_section) ? True : False;
                    break;
                }
            }
        }
    }


    private function register_section_users(){
        if(!$this->content->users()->where('user_id',auth()->user()->id)->exists())
            $this->content->users()->attach(auth()->user()->id,['created_at'=>now(),'updated_at'=>now()]);
        $this->number_finished_sections();
    }

    function number_finished_sections():int{
        /** @var User $user description */
        $user = auth()->user();
        return count($user->sections()->where('lesson_id',$this->content->lesson->id)->get());
    }


    public function render()
    {
        $this->has_prev_or_next();
        return view('livewire.cours.section',[
            'content' => $this->content
        ]);
    }
}
