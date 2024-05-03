<div>
<x-starterkid::starterkid.card>
                <x-slot name="header">
                @can('create',\GrassFeria\StarterkidWiki\Models\Wiki::class)
                <a href="{{route('wikis.create')}}" title="{{__('Create wiki')}}">
                <x-starterkid::starterkid.button-primary type="button">{{__('Create wiki')}}</x-starterkid::starterkid.button-primary>
                </a>
                @endcan
                </x-slot>

            <x-starterkid::starterkid.table-panel :selected="$selected">
            <x-slot name="tableHeader">
            <x-starterkid::starterkid.input wire:model.live.debounce.600ms="search" id="search" type="search" placeholder="{{__('Search')}}" class="w-full xl:w-1/4"/>
            <x-starterkid::starterkid.input-select wire:model.live="perPage" class="w-full xl:w-1/6">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </x-starterkid::starterkid.input-select>
            <x-starterkid::starterkid.input-select wire:model.live="orderBy" class="w-full xl:w-1/6">
                <option value="id">{{__('ID')}}</option>
            </x-starterkid::starterkid.input-select>
            <x-starterkid::starterkid.input-select wire:model.live="sort" class="w-full xl:w-1/6">
                <option value="ASC">{{__('ASC')}}</option>
                <option value="DESC">{{__('DESC')}}</option>
               </x-starterkid::starterkid.input-select>
            </x-slot>
            <thead>
            <x-starterkid::starterkid.tr>
            <x-starterkid::starterkid.th></x-starterkid::starterkid.th>
            <x-starterkid::starterkid.th>{{__('ID')}}</x-starterkid::starterkid.th>
            <x-starterkid::starterkid.th>{{__('Name')}}</x-starterkid::starterkid.th>
            <x-starterkid::starterkid.th>{{__('Published')}}</x-starterkid::starterkid.th>
            <x-starterkid::starterkid.th>{{__('View')}}</x-starterkid::starterkid.th>
            <x-starterkid::starterkid.th>{{__('Status')}}</x-starterkid::starterkid.th>
            
            </x-starterkid::starterkid.tr>
            </thead>
            <x-starterkid::starterkid.tbody>

            @foreach($wikis as $wiki)
            <x-starterkid::starterkid.tr wire:key="tr_row_{{$wiki->id}}">
                <x-starterkid::starterkid.td>
                @can('delete',[\GrassFeria\StarterkidWiki\Models\Wiki::class,$wiki])
                <x-starterkid::starterkid.input-checkbox wire:model.live="selected" wire:key="{{$wiki->id}}" value="{{$wiki->id}}" />
                @endcan
                </x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>{{$wiki->id}}</x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>{{$wiki->name}}</x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>{{$wiki->getPublished()}}</x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>
                    @if($wiki->status === true)
                    <a target="_blank" href="{{route('front.wiki.show',$wiki->slug)}}" title="{{$wiki->name}}">
                        <x-starterkid::starterkid.button-secondary type="button">{{__('View')}}</x-starterkid::starterkid.button-secondary>
                    </a>
                    @endif
                </x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>
                    @if($wiki->status === true)
                    <x-starterkid::starterkid.badge-success>{{__('Online')}}</x-starterkid::starterkid.badge-success>
                    @else
                    <x-starterkid::starterkid.badge-danger>{{__('Offline')}}</x-starterkid::starterkid.badge-danger>
                    @endif
                </x-starterkid::starterkid.td>
                <x-starterkid::starterkid.td>
                    @can('update',[\GrassFeria\StarterkidWiki\Models\Wiki::class,$wiki])
                    <a href="{{route('wikis.edit',$wiki->id)}}" title="{{__('Edit')}}">
                        <x-starterkid::starterkid.button-primary type="button">{{__('Edit')}}</x-starterkid::starterkid.button-primary>
                    </a>
                   @endcan
                </x-starterkid::starterkid.td>
                </x-starterkid::starterkid.tr>
            @endforeach

            </x-starterkid::starterkid.tbody>
            <x-slot name="pagination">
                {{$wikis->links()}}
            </x-slot>
            </x-starterkid::starterkid.table-panel>

        </x-starterkid::starterkid.card>
</div>