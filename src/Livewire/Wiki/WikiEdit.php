<?php

namespace GrassFeria\StarterkidWiki\Livewire\Wiki;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class WikiEdit extends Component
{
    use WithFileUploads;

    public $wiki;
    public $name;
    public $title;
    public $content;
    public $created_at;
    public $status = true;
    public $slug;
    public $description;
    public $focus_keyword;
    public $public_files = [];
    
    



    public function mount($recordId = null)
    {
        
       
        $this->wiki       = \GrassFeria\StarterkidWiki\Models\Wiki::find($recordId);
      
        $this->authorize('update',[\GrassFeria\StarterkidWiki\Models\Wiki::class,$this->wiki]);
        $this->name                             = $this->wiki->name;
        $this->title                            = $this->wiki->title;
        $this->content                          = $this->wiki->content;
        $this->description                      = $this->wiki->description;
        $this->created_at                       = $this->wiki->created_at->format(config('starterkid.time_format.date_time_format_for_picker'));
        $this->status                           = $this->wiki->status;
        $this->slug                             = $this->wiki->slug;
        $this->focus_keyword                    = $this->wiki->focus_keyword;
        //$this->date                                 = $this->wiki->date->format(config('starterkid.time_format.date_format_for_picker'));
        //$this->date_time                            = $this->wiki->date_time->format(config('starterkid.time_format.date_time_format_for_picker'));
        //$this->time                                 = $this->wiki->time->format(config('starterkid.time_format.time_format_for_picker'));
            
       
    }

    public function save()
    {


        $validated = $this->validate([
            'name'                      => 'required|string',
            'slug'                      => ['required', 'string', Rule::unique('wikis')->ignore($this->wiki->id)],
            'title'                     => 'required|string',
            'content'                   => 'required|string',
            'description'               => 'required|string',
            'focus_keyword'             => ['required', 'string', Rule::unique('wikis')->ignore($this->wiki->id)],
            'created_at'                 => 'required|date_format:' . config('starterkid.time_format.date_time_format_for_picker'),
            'status'                    => 'required|boolean',
            
            //'title'                     => 'required|string',
            //'color'                     => 'required|string',
            //'range'                     => 'required|string',
            //'about'                     => 'required|string',
            //'country'                   => 'required|string',
            //'active'                    => 'required|boolean',
            //'radio'                     => 'required|string',
            //'date'                      => 'required|date_format:' . config('starterkid.time_format.date_format_for_picker'),
            //'date_time'                 => 'required|date_format:' . config('starterkid.time_format.date_time_format_for_picker'),
            //'time'                      => 'required|date_format:' . config('starterkid.time_format.time_format_for_picker'),
            //'body'                      => 'required|string',
            //'youtube_video_link'        => 'required|string',
            //'vimeo_video_link'          => 'required|string',
           
        ]);
        
       
        $this->authorize('update',[\GrassFeria\StarterkidWiki\Models\Wiki::class,$this->wiki]);
        $validated = array_merge($validated, ['user_id' => auth()->user()->id]);
        $this->wiki->update($validated);
       

        //if ($this->public_photos !== []) {
        //\GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($this->wiki,'avatars');
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaWithFilenameService($this->public_photos,$this->wiki,'photos','public','my-new-filename'));
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaService($this->public_photos, $this->wiki, 'photos', 'public'));
        //}

        if ($this->public_files !== []) {
            \GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($this->wiki,'files');
            (new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaWithFilenameService($this->public_files,$this->wiki,'files','public',$this->title));
            //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaService($this->public_photos, $this->wiki, 'photos', 'public'));
            }
        
        (new \GrassFeria\Starterkid\Services\CheckCkEditorContent($this->wiki->content,'content'))->checkForCkEditorImages($this->wiki,'images','ckimage');
        return redirect()->route('wikis.index')->with('success', __('Wiki updated'));

    }

    public function removeFile($fileId)
    {
       
        // delete files if click delete button on filepond form
        
        // public_photos
         Storage::delete('livewire-tmp'.'/'.$fileId);
         foreach($this->public_photos as $key => $file){
           if($file->getFilename() == $fileId){
             unset($this->public_photos[$key]);
           }
         }

         // more here
 
    }


    public function render()
    {
        
        return view('starterkid-wiki::livewire.wiki.wiki-edit');
        
    }
}
