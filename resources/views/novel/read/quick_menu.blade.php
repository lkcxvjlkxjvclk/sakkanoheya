

{{-- quickMenu START --}}
    <div id="quickMenu">
        <div class="row">
            <div class="col-md-2 text-left">
                {{-- + - Button COLLAPSE --}}
                <a class="remoteButton" data-toggle="collapse" href="#collapseRemote" aria-expanded="false" aria-controls="collapseRemote">
                    <i id="remoteMenu" class="fa fa-minus-square-o" aria-hidden="true"></i>
                </a>
                {{-- PAGE-UP Button --}}
                <a class="remoteArrow" href="#"><i id="remoteUp" class="fa fa-arrow-up" aria-hidden="true"></i></a>
                {{-- PAGE-DOWN Button --}}
                <a class="remoteArrow" href="#"><i id="remoteDown" class="fa fa-arrow-down" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-10 collapse in remote-button" id="collapseRemote">
                {{-- REMOTE TITLE & X Button --}}
                {{-- Novel TITLE --}}
                {{-- Novel EPISODSE MOVE --}}
                {{-- Viewer Settings --}}
                {{-- Novel BACKGROUND --}}
                <table class="table text-center">
                    <tr>
                        <th>
                            <strong>リモコン</strong>
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" onchange="location = this.value;">
                                @for ($i = count($dataE); $i > 0; $i--)
                                    <option class="quickList" name="{{$i}}" value="/novel/read/novel_read_view/{{$dataE[0]['novel_id']}}&{{$i}}">
                                        {{$i}}話. {!! $dataE[$i-1]['episode_title'] !!}
                                    </option>
                                @endfor
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td data-toggle="modal" data-target="#viewerModal">
                            <p class="remote">
                                <a class="setView" href="#">
                                    <i class="material-icons">settings</i>&nbsp;<span>ビューアー設定</span>
                                </a>
                            </p>
                        </td>
                    </tr>
                    @if (!isset($dataE[0]['noBack']))
                        <tr>
                            <td data-toggle="modal" data-target="#backgroundModal">
                                <p class="remote">
                                    <a class="novelBackground" href="#">
                                        <i class="material-icons">remove_red_eye</i>&nbsp;<span>小説設定</span>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    {{-- quickMenu END --}}
