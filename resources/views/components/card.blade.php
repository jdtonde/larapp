{{-- stype pour les card.
 $attributes->merge(['class'...  permert de rajouter après des attributs  dans le listing.blade  grace  a la class  --}}

 <div {{$attributes->merge(['class'=>'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}
</div>
