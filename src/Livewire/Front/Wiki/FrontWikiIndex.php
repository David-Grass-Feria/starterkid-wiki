<?php

namespace GrassFeria\StarterkidWiki\Livewire\Front\Wiki;


use Livewire\Component;
use Livewire\Attributes\Layout;
use GrassFeria\Starterkid\Traits\LivewireIndexTrait;



class FrontWikiIndex extends Component
{

   
   use LivewireIndexTrait;

   public $robots;
   
   public function mount()
   {
      $this->orderBy = 'name';
      $this->sort = 'asc';
   }
  
    #[Layout('starterkid-frontend::components.layouts.front')]
    public function render()
    {
     
      //$wikis = \GrassFeria\StarterkidWiki\Models\Wiki::frontGetWikiWhereStatusIsOnline($this->search,$this->orderBy, $this->sort)->get();
      $wikis = \GrassFeria\StarterkidWiki\Models\Wiki::frontGetWikiWhereStatusIsOnline($this->search, 'slug', 'asc')->get();
      $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline($this->search,$this->orderBy, $this->sort)->get();
      return view('starterkid-wiki::livewire.front.wiki.front-wiki-index',['services' => $services,'wikis' => $wikis]);

        
    }
}