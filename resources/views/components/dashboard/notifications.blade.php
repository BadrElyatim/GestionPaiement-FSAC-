
<div id="notifications" class='absolute hidden right-full mt-2 shadow-lg bg-white py-2 z-[1000] min-w-full rounded-lg w-[410px] max-h-[500px] overflow-auto'>
  <div class="flex items-center justify-between my-4 px-4">
    <p class="text-xs text-blue-500 cursor-pointer">Mark as read</p>
  </div>
  <ul class="divide-y">
    @foreach (auth()->user()->notifications as $notification)
      <li class='py-4 px-4 flex items-center hover:bg-gray-50 text-black text-sm cursor-pointer'>
        <div>
          <h3 class="text-sm text-[#333] font-semibold">Your have a new remark from {{ $notification->data['from']['prenom'] }} {{ $notification->data['from']['nom'] }}</h3>
            <p class="text-sm text-gray-600 mt-2">{{ $notification->data['remarque'] }}</p>
            <p class="text-xs text-gray-400">etudiant: {{ $notification->data['etudiant']['prenom'] }} {{ $notification->data['etudiant']['nom'] }}, numero tranche: {{ $notification->data['tranche_id'] }}</p>
            <p class="text-xs text-blue-500 leading-3 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
        </div>
      </li>   
    @endforeach
  </ul>    
</div>