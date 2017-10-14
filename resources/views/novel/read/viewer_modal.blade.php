{{-- Viewer Setting Modal START --}}
    <div class="modal fade" id="viewerModal" tabindex="-1" role="dialog" aria-labelledby="backgroundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="viewerModalLabel"><i class="material-icons">settings</i>&nbsp;<span>ビューアー設定</span></h4>
                </div>
                <div class="modal-body">
                    {{-- Screen MODE --}}
                    <div class="container-fluid">
                        <div class="row">
                            {{--  <div class="col-md-2 text-left">  --}}
                                {{--  <h5><strong>画面モード</strong></h5>  --}}
                            {{--  </div>  --}}
                            {{--  <div class="col-md-7 text-left">  --}}
                                {{-- 50px x 50px 화면 모드 이미지 버튼 2개 --}}
                                {{--  <ul class="list-inline">  --}}
                                    {{--  <li class="viewScreen webMode viewOn">  --}}
                                        {{-- WEB MODE --}}
                                    {{--  </li>  --}}
                                    {{-- <li class="viewScreen bookMode viewOff"> --}}
                                        {{-- E-Book MODE --}}
                                    {{-- </li> --}}
                                {{--  </ul>
                            </div>  --}}
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-default" name="reset"><i class="material-icons">settings_backup_restore</i>元通りに</button>
                            </div>
                        </div>
                    </div>
                    {{-- Setting --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <h5><strong>ビューアー設定</strong></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 example-text">
                                むかしむかし、ある所に、おじいさんとおばあさんが住んでいました。二人には子供がなかったので、さびしく暮していました。
                                毎日、おじいさんは山へ柴刈りに、おばあさんは川へ洗濯に行きました。ある日のこと、おばあさんが川で洗濯をしていると、川上から大きな桃が、どんぶらこどんぶらこと流れてきました。
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 text-left">
                                <h5><strong>書体</strong></h5>
                                <ul class="list-group">
                                    <li class="list-group-item fontList on-font" value="Noto Sans">Noto Sans</li>
                                    <li class="list-group-item fontList off-font" value="Kokoro">Kokoro</li>
                                    <li class="list-group-item fontList off-font" value="Sawarabi Mincho">Sawarabi Mincho</li>
                                </ul>
                            </div>
                            <div class="col-md-3 text-left">
                                <h5><strong>文サイズ</strong></h5>
                            <ul class="list-group">
                                    <li class="list-group-item sizeList off-font">12px</li>
                                    <li class="list-group-item sizeList on-font">14px</li>
                                    <li class="list-group-item sizeList off-font">16px</li>
                                    <li class="list-group-item sizeList off-font">18px</li>
                                    <li class="list-group-item sizeList off-font">20px</li>
                                    <li class="list-group-item sizeList off-font">26px</li>
                                </ul>
                            </div>
                            <div class="col-md-3 text-left">
                                <h5><strong>行間隔</strong></h5>
                                <ul class="list-group">
                                    <li class="list-group-item lineList off-font">120%</li>
                                    <li class="list-group-item lineList off-font">150%</li>
                                    <li class="list-group-item lineList off-font">160%</li>
                                    <li class="list-group-item lineList on-font">170%</li>
                                    <li class="list-group-item lineList off-font">180%</li>
                                    <li class="list-group-item lineList off-font">200%</li>
                                </ul>
                            </div>
                            <div class="col-md-3 text-left">
                                <h5><strong>フォント色</strong></h5>
                                <ul class="list-inline">
                                    <li class="colorBox on-colorBox font-color" value="#000000">{{-- 色1 black --}}</li>
                                    <li class="colorBox off-colorBox font-color" value="#ffffff">{{-- 色5 white --}}</li>
                                </ul>
                                <h5><strong>背景色</strong></h5>
                                <ul class="list-inline">
                                    <li class="colorBox on-colorBox back-color" value="#ffffff">{{-- 色1 white --}}</li>
                                    <li class="colorBox off-colorBox back-color" value="#ffd480">{{-- rgb(255, 212, 128) --}}</li>
                                    <li class="colorBox off-colorBox back-color" value="#e6ffe6">{{-- rgb(230, 255, 230) --}}</li>
                                    <li class="colorBox off-colorBox back-color" value="#e0ccff">{{-- rgb(224, 204, 255) --}}</li>
                                    <li class="colorBox off-colorBox back-color" value="#000000">{{-- 色5 blac --}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
            {{-- modal-content END --}}
        </div>
        {{-- modal-dialog END --}}
    </div>
    {{-- Viewer Setting Modal END --}}