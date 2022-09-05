<x-layout>
@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@unless (count($listing) == 0)

@foreach($listing as $list)
    {{-- <h2> <a href="/listings/{{$list['id']}}"> {{$list['title']}}</a> </h2>
    <p> {{$list['description']}}</p> --}}
    
    <x-job-card :list="$list"/> 

@endforeach

@else
 <p class="text-rose-400 text-2xl mt-6 p-6 ">No posts found</p>
@endunless
</div>

<div class="mt-6 p-4">
    {{ $listing->links() }}
</div>

</x-layout>

