 @props([
    'id' => null
 ])
 
 <div tabindex="-1" {{ $attributes->merge([
    'id' => $id
 ]) }}
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[99999] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative p-4 w-full max-w-md max-h-full">
         <div class="relative bg-white rounded-lg shadow-sm">
             {{ $slot }}
         </div>
     </div>
 </div>
