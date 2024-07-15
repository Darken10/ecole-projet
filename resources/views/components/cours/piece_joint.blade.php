@props(['content'])
<div class="my-4 border-t-2 ">
    @if (count($content->piece_joints)>0)
    <h3 class=" text-3xl my-2 text-center">Annexes</h3>
    <div class=" w-full">
        @foreach ($content->piece_joints as $piece_joint)
        <div class=" max-w-sm gap-4 flex ">
            @switch($piece_joint->type_piece_joint_id)
                @case(1)
                    <img src="{{ asset('storage/'.$piece_joint->url) }}" class="w-full" alt="">
                    @break
                @case(2)
                    <video  src="{{ asset('storage/'.$piece_joint->url) }}" controls></video>
                    @break
                @case(3)
                    <div>
                        <img src="{{ asset('icone/1149576.png') }}"  alt="">
                    </div>
                    @break
                @case(4)
                    <audio src="{{ asset('storage/'.$piece_joint->url) }}" controls></audio>
                    @break
                @case(5)
                    
            @endswitch
        </div>
        
        <p>
            Titre : {{ $piece_joint->title }}
        </p>
        <p class=" text-sm underline cursor-pointer">
            <a href="{{ asset('storage/'.$piece_joint->url) }}" download>Telecharger</a>
        </p>
        @endforeach
    </div>

@endif
</div>