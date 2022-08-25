@props(['listing'])

<x-card class="p-10">

    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
              src="{{asset($listing->logo ? asset('storage/'.$listing->logo) : asset('images/no-image.png') )}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                 {{-- $listing->id équivaut à $listing['id'] --}}
                <a href="/listings/{{$listing->id}}">{{$listing->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tag :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>{{$listing->location}}
            </div>
        </div>
    </div>
</x-card>
