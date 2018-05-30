<h5>
    {{ trans('app.categories') }}
    <a href="{{ url(Session::get('guard') . '/media_manager_categories') }}" data-toggle="modal" data-target="#ajaxmodel" data-remote="{{ url(Session::get('guard') . '/media_manager_categories/create') }}"><i class="fa fa-plus-circle"></i></a>
</h5>
<ul style="font-family:Menlo,Monaco,Consolas,'Courier New','monospace';font-size:12px;padding-left: 18px;">
    @foreach($categories as $category)
        <li>
            <a href="{{ url(Session::get('guard') . '/media_manager_categories/edit/' . $category->id) }}" data-toggle="modal" data-target="#ajaxmodel" data-remote="{{ url(Session::get('guard') . '/media_manager_categories/edit/' . $category->id) }}">
                <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ url(Session::get('guard') . '/media_manager/' . $category->id) }}" class="fetchajaxpage">
                {{ $category->title }}
            </a>
             <a href="{{ url(Session::get('guard') . '/media_manager_categories') }}" data-toggle="modal" data-target="#ajaxmodel" data-remote="{{ url(Session::get('guard') . '/media_manager_categories/create/' . $category->id) }}"><i class="fa fa-plus-circle"></i></a>
            @if(count($category->childs))
                @include(Session::get('guard') . '.media_manager_categories.ajax.list_child',['childs' => $category->childs, 'link' => $category->id])
            @endif
        </li>
    @endforeach
</ul>