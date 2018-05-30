<ul style="padding-left: 15px;">
    @foreach($childs as $child)
        <li>
            <a href="{{ url(Session::get('guard') . '/media_manager_categories/edit/' . $child->id) }}" data-toggle="modal" data-target="#ajaxmodel" data-remote="{{ url(Session::get('guard') . '/media_manager_categories/edit/' . $child->id) }}">
                <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ url(Session::get('guard') . '/media_manager/' . $link . '_' . $child->id) }}" class="fetchajaxpage">
                {{ $child->title }}
            </a>
            <a href="{{ url(Session::get('guard') . '/media_manager_categories') }}" data-toggle="modal" data-target="#ajaxmodel"
               data-remote="{{ url(Session::get('guard') . '/media_manager_categories/create/' . $child->id) }}"><i
                        class="fa fa-plus-circle"></i></a>
            @if(count($child->childs))
                @include(Session::get('guard') . '.media_manager_categories.ajax.list_child',['childs' => $child->childs,'link' => $link . '_' . $child->id])
            @endif
        </li>
    @endforeach
</ul>