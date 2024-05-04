<x-slot:title>{{$wiki->name}}</x-slot>
<x-slot:robots>index, follow</x-slot>
<x-slot:description>{{$wiki->description}}</x-slot>

<div>
    @include('starterkid-frontend::header')
    


    <x-starterkid-frontend::card>

      
    <x-starterkid-frontend::wrapper>
   
  
    <x-starterkid-frontend::body-content heading="{{$wiki->name}}" content="{!!$wiki->content!!}" imgSrc="{{$wiki->getFirstMediaUrl('images','large')}}" imgAlt="{{$wiki->name}}" imageCredits="{{$wiki->image_credits}}" />

    
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


@section('schema')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "{{$wiki->name}}",
      "description": "{{$wiki->description}}",
      "publisher": {
        "@type": "EducationalOrganization",
        "name": "{{config('app.name')}}",
        "url": "{{url()->current()}}"
      },
      "inLanguage": "de-DE",
      "lastReviewed": "{{$wiki->getPublished()}}"
    }
    </script>
@endsection
@section('meta')
<meta property="og:title" content="{{$wiki->name}}" />
<meta property="og:description" content="{{ $wiki->description ?? '' }}" />
<meta property="og:image" content="{{$wiki->getFirstMediaUrl('images','large') ?? ''}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:type" content="website" />
@endsection
    
    @include('starterkid-frontend::footer',['services' => $services])
</div>