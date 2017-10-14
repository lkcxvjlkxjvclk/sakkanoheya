@foreach ($data as $list)
    <option value="{{ $list['id'] }}">{!! $list['menu_title'] !!}</option>
@endforeach