<div>
        <x-starterkid::starterkid.card>
                <x-slot name="header">
                <a href="{{route('wikis.index')}}" title="{{__('Wiki list')}}">
                <x-starterkid::starterkid.button-secondary type="button">{{__('Back')}}</x-starterkid::starterkid.button-secondary>
                </a>
                </x-slot>
                <x-starterkid::starterkid.form cancelRoute="{{route('wikis.index')}}">
                
                <x-starterkid::starterkid.form.text wire:model.live="name" for="name" id="name" type="text" label="{{__('Heading')}}" required/>
                <x-starterkid::starterkid.form.text wire:model="title" for="title" id="title" type="text" label="{{__('Title')}}" required/>
                <x-starterkid::starterkid.form.text wire:model="focus_keyword" for="focus_keyword" id="focus_keyword" type="text" label="{{__('Focus keyword')}}" description="{{__('The focus keyword is the main term of your page for which you want to achieve a good ranking in search engines such as Google. An example: If your focus keyword is (steel mills in Berlin), using this term on your website increases visibility and relevance in search results, which leads to better positioning. The keyword should also be present in the introductory text.')}}" required/>
                <x-starterkid::starterkid.form.slug wire:model="slug" slug="{{url('/')}}/{{config('starterkid-wiki.wiki_slug')}}/" for="slug" id="slug" type="text" label="{{__('Slug')}}" required/>
                
                <x-starterkid::starterkid.form.textarea wire:model="description" for="description" id="description" rows="2" label="{{__('Description')}}" required>
               </x-starterkid::starterkid.form.textarea>

                
               
                
                <x-starterkid::starterkid.form.ckeditor5 wire:model="content" for="content" id="content" rows="5" label="{{__('Content')}}" required>
                {!!$wiki->content!!}
                </x-starterkid::starterkid.form.ckeditor5>

                <x-starterkid::starterkid.form.file multiple wire:model="public_files" for="public_files" id="public_files" label="{{__('Files')}}" maxFileSize="{{config('starterkid.max_file_size_mb')}}MB" maxTotalFileSize="{{config('starterkid.max_file_size_mb')}}MB">
                        <x-slot name="acceptedFileTypes">
                        'application/*'
                        </x-slot>
                        </x-starterkid::starterkid.form.file>
                        <livewire-starterkid::show-file key="public_files_{{$wiki->id}}" :record="$wiki" collection="files" divClass="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-1 mt-5 mb-5" imgClass="h-32" enableFileDelete />

                <x-starterkid::starterkid.form.datetime wire:model="created_at" for="created_at" id="created_at" label="{{__('Published')}}" required />
                <x-starterkid::starterkid.form.checkbox for="status" id="status" label="{{__('Status')}}">
                <x-starterkid::starterkid.input-checkbox-radio-panel>
                <x-starterkid::starterkid.input-checkbox wire:model="status" name="status" />
                <x-starterkid::starterkid.label>{{__('Online')}}</x-starterkid::starterkid.label>
                </x-starterkid::starterkid.input-checkbox-radio-panel>
                </x-starterkid::starterkid.form.checkbox>
              

                </x-starterkid::starterkid.form>


        </x-starterkid::starterkid.card>
        </div>