<x-slot:robots>index,follow</x-slot>

<x-slot:title>{{config('starterkid-wiki.wiki_title')}}</x-slot>


<x-slot:description>{{config('starterkid-wiki.wiki_description')}}</x-slot>

<div>
    @include('starterkid-frontend::header')
    

<x-starterkid-frontend::card>
    <x-starterkid-frontend::card-header heading="{{config('starterkid-wiki.wiki_title')}}" description="{{config('starterkid-wiki.wiki_description')}}" />
      
    <x-starterkid-frontend::wrapper>
    
        <x-slot name="header">
            <x-starterkid::starterkid.input wire:model.live.debounce.600ms="search" id="search" type="search" placeholder="{{__('Search')}}" class="w-full xl:w-1/4"/>
        </x-slot>
     
    
          
        <x-starterkid-frontend::wiki-list>
            @foreach($wikis as $wiki)
            <x-starterkid-frontend::wiki-list-item :firstLoop="$loop->first"
            imgSrc="{{asset('wikipedia.svg')}}"
            imgAlt="{{$wiki->name}}"
            href="{{route('front.wiki.show',$wiki->slug)}}"
            hrefTitle="{{$wiki->focus_keyword}}"
            heading="{{$wiki->name}}"
            preview="{!!Str::limit($wiki->description,200)!!}"
            />
            
          @endforeach 
         
        </x-starterkid-frontend::wiki-list>
         
      
   
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>