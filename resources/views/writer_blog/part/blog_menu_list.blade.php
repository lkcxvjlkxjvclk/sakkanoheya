<ul>
    {{--  {{print_r($data)}}  --}}
    @foreach ($data as $menu)
        <li>
            <a href="/yerriel/blog/menu/{{ $menu['id'] }}"> 
            {{--  name="blog_click"  --}}
                {{--  <input type="hidden" value="{{ $menu['id'] }}" name="blog_href" />  --}}
                {!! $menu['menu_title'] !!}
            </a>
        </li>
    @endforeach
</ul>