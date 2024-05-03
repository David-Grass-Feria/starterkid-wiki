<?php

namespace GrassFeria\StarterkidWiki\Livewire\Wiki;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class WikiCreate extends Component
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
    
    



    public function mount($recordId = null)
    {
        
        $this->authorize('create',\GrassFeria\StarterkidWiki\Models\Wiki::class);
        $this->created_at                              = now()->format(config('starterkid.time_format.date_time_format_for_picker'));
        //$this->date                                 = now()->format(config('starterkid.time_format.date_format_for_picker'));
        //$this->date_time                            = now()->format(config('starterkid.time_format.date_time_format_for_picker'));
        //$this->time                                 = now()->format(config('starterkid.time_format.time_format_for_picker'));
        
    }

    public function updated($name)
    {
        $this->slug = Str::slug($this->name);
        $this->title = ucfirst($this->name);
    }

    public function save()
    {


        $validated = $this->validate([
            'name'                      => 'required|string',
            'slug'                      => 'required|string|unique:wikis',
            'title'                     => 'required|string',
            'content'                   => 'required|string',
            'description'               => 'required|string',
            'focus_keyword'             => 'required|string|unique:wikis',
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
        
        
        $this->authorize('create',\GrassFeria\StarterkidWiki\Models\Wiki::class);
        $validated = array_merge($validated, ['user_id' => auth()->user()->id]);
        $this->wiki = \GrassFeria\StarterkidWiki\Models\Wiki::create($validated);
        
        //if ($this->public_photos !== []) {
        //\GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($this->wiki,'avatars');
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaWithFilenameService($this->public_photos,$this->wiki,'photos','public','my-new-filename'));
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaService($this->public_photos, $this->wiki, 'photos', 'public'));
        //}
        
        (new \GrassFeria\Starterkid\Services\CheckCkEditorContent($this->wiki->content,'content'))->checkForCkEditorImages($this->wiki,'images','ckimage');
        return redirect()->route('wikis.index')->with('success', __('Wiki created'));

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
        
        return view('starterkid-wiki::livewire.wiki.wiki-create');
        
    }
}
