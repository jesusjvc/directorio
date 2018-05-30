<div class="b-all">
    <div class="">

        <img class="img-responsive" alt="user" src="{{ $professional->avatarlist }}">
        <div class="text-center listing-box">
            <div class="title">{{ ucwords($professional->firstname . ' ' . $professional->lastname) }}</div>
            <div class="rating">
                {!! CustomHelper::htmlRating($professional->score) !!}
            </div>
            <hr>
            <div class="m-b-10">
                {{ $professional->profile->business_name }}
            </div>
            <div class="m-b-10">
                <i class="fa fa-phone"></i>
                +{{ $professional->profile->business_phone }}
            </div>
            <div class="m-b-10">
                <i class="fa fa-envelope"></i> {{ $professional->profile->business_email }}
            </div>
            <hr>
            @foreach($professional->child_categories as $child_category)
                <div class="text-left" style="font-weight: 400;"><i
                            class="fa fa-check"></i> {{ $child_category->title }}</div>
            @endforeach
        </div>

    </div>
</div>