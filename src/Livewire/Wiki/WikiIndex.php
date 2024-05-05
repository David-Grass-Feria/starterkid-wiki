<?php

namespace GrassFeria\StarterkidWiki\Livewire\Wiki;


use Livewire\Component;
use GrassFeria\Starterkid\Traits\LivewireIndexTrait;


class WikiIndex extends Component
{

    use LivewireIndexTrait;


    public function mount()
    {
        $this->authorize('viewAny',\GrassFeria\StarterkidWiki\Models\Wiki::class);
    }

    public function destroyRecords()
    {
        
        foreach ($this->selected as $recordId) {
            $findRecord = \GrassFeria\StarterkidWiki\Models\Wiki::find($recordId);
            $this->authorize('delete',[\GrassFeria\StarterkidWiki\Models\Wiki::class,$findRecord]);
            \GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($findRecord,'wikis');
            $findRecord->delete();

        }

        $this->selected = [];


    }


    public function render()
    {

      
        $wikis = \GrassFeria\StarterkidWiki\Models\Wiki::query()
        ->select('id','user_id','name','created_at','status','slug','focus_keyword')
        ->where('id','like','%'.$this->search.'%')
        ->orWhere('name','like','%'.$this->search.'%')
        ->orderBy($this->orderBy, $this->sort)
        ->paginate($this->perPage);

        return view('starterkid-wiki::livewire.wiki.wiki-index',['wikis' => $wikis]);

        
    }
}
