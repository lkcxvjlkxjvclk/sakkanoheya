@php
    use App\Http\Controllers\NovelController;
@endphp

<script src="/js/JHM-Custom/jhm-background-custom.js"></script>

{{-- Background Modal START --}}
<div class="modal fade" id="backgroundModal" tabindex="-1" role="dialog" aria-labelledby="backgroundModalLabel" aria-hidden="true">
    <div class="modal-dialog huge-size">
        <div class="modal-content huge-size">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="backgroundModalLabel"><i class="material-icons">remove_red_eye</i>&nbsp;<span>小説設定</span></h4>
            </div>
            <div class="modal-body">
                    
                <div class="background-fluid container-fluid">
                    <div class="row">
                        {{-- BACKGROUND ICON --}}
                        <div class="col-md-1 text-center">
                            {{-- Novel History --}}
                            <div data-name="collapseHistory">
                                <h1><i class="fa fa-clock-o selectedIcon" aria-hidden="true" name="backgroundIcon"></i></h1>
                            </div>
                            {{-- Novel Character-Set --}}
                            <div data-name="collapseCharacter">
                                <h1><i class="fa fa-user" aria-hidden="true" name="backgroundIcon"></i></h1>
                            </div>
                            {{-- Novel Items --}}
                            <div data-name="collapseItem">
                                <h1><i class="fa fa-shopping-cart" aria-hidden="true" name="backgroundIcon"></i></h1>
                            </div>
                            {{-- Novel Relation --}}
                            <div data-name="collapseRelation">
                                <h1><i class="fa fa-users" aria-hidden="true" name="backgroundIcon"></i></h1>
                            </div>
                            {{-- Novel Map --}}
                            <div data-name="collapseMap">
                                <h1><i class="fa fa-map" aria-hidden="true" name="backgroundIcon"></i></h1>
                            </div>
                        </div>

                        {{-- <div> --}}
                            {{-- HISTORY CONTEXT --}}
                            <div class="col-md-11" id="collapseHistory">
                                {{-- History --}}
                                @php
                                    echo NovelController::backgroundHistory($id);
                                @endphp
                            </div>
                            {{-- CAHRACTER CONTEXT --}}
                            <div class="col-md-11" id="collapseCharacter">
                                {{-- Character --}}
                                @php
                                    echo NovelController::backgroundCharacter($id);
                                @endphp
                            </div>
                            {{-- ITEM CONTEXT --}}
                            <div class="col-md-11" id="collapseItem">
                                {{-- Item --}}
                                @php
                                    echo NovelController::backgroundItem($id);
                                @endphp
                            </div>
                            {{-- RELATION CONTEXT --}}
                            <div class="col-md-11" id="collapseRelation">
                                {{-- Relation --}}
                                @php
                                    echo NovelController::backgroundRelation($id);
                                @endphp
                            </div>
                            {{-- MAP CONTEXT --}}
                            <div class="col-md-11" id="collapseMap">
                                {{-- Map --}}
                                @php
                                    echo NovelController::backgroundMap($id);
                                @endphp
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        {{-- modal-content END --}}
    </div>
    {{-- modal-dialog END --}}
</div>
{{-- Background Modal END --}}