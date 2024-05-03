<?php

use Illuminate\Support\Facades\Route;
use \GrassFeria\StarterkidWiki\Livewire\Wiki\WikiEdit;
use \GrassFeria\StarterkidWiki\Livewire\Wiki\WikiIndex;
use \GrassFeria\StarterkidWiki\Livewire\Wiki\WikiCreate;
use GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiShow;
use GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiIndex;
//use \GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiShow;
//use \GrassFeria\StarterkidWiki\Livewire\Front\Wiki\FrontWikiIndex;




Route::middleware(['web'])->group(function () {
   
    Route::get(config('starterkid-wiki.wiki_slug'),FrontWikiIndex::class)->name('front.wiki.index')->middleware('minify');
    Route::get(config('starterkid-wiki.wiki_slug').'/{slug}',FrontWikiShow::class)->name('front.wiki.show')->middleware('cache','minify');
  

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   
    Route::get('/dashboard/wikis',WikiIndex::class)->name('wikis.index');
    Route::get('/dashboard/wikis/create',WikiCreate::class)->name('wikis.create');
    Route::get('/dashboard/wikis/edit/{recordId}',WikiEdit::class)->name('wikis.edit');

    


   
});