<?php

namespace GrassFeria\StarterkidWiki\Livewire\Front\Wiki;


use Livewire\Component;
use Livewire\Attributes\Layout;
use GrassFeria\Starterkid\Traits\LivewireIndexTrait;



class FrontWikiShow extends Component
{

   
   public $service;
   public $wiki; 
   
   public function mount($slug)
   {
      $this->wiki = \GrassFeria\StarterkidWiki\Models\Wiki::where('slug',$slug)->firstOrFail();
   }

  
    #[Layout('starterkid-frontend::components.layouts.front')]
    public function render()
    {
     
     
      $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline()->get();
      return view('starterkid-wiki::livewire.front.wiki.front-wiki-show',['services' => $services]);

        
    }
}