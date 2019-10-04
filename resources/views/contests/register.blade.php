@extends('layouts.app')

@section('template')

<style>
    .form-control:disabled, .form-control[disabled]{
        background-color: transparent;
    }

    contest,card,.carousel{
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
        overflow: hidden;
        z-index: 0;
    }

    card{
        padding:1rem;
    }

    contest > .atsast-img-container{
        overflow: hidden;
        height:15rem;
        width:35rem;
        position: absolute;
        top:-2.5rem;
        right:-2.5rem;
    }

    contest:hover,
    card:hover {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
    }

    contest > .atsast-img-container-small{
        width:100%;
        height:15rem;
    }

    contest > .atsast-img-container-small > img{
        height:100%;
        width:100%;
        object-fit: cover;
    }

    contest > .atsast-img-container::after{
        content: "";
        display: block;
        position: absolute;
        z-index: 1;
        top:-2.5rem;
        left:-2.5rem;
        bottom:-2.5rem;
        right:-1px;
        background:linear-gradient(to right,rgba(255,255,255,1) 10%,rgba(255,255,255,0) 100%);
    }

    contest > .atsast-content-container{
        /* display: flex;
        align-items: center; */
        height:100%;
        flex-shrink: 1;
        flex-grow: 1;
        padding:1rem;
        z-index: 1;
    }

    contest > .atsast-img-container > img{
        height:100%;
        width:100%;
        object-fit: cover;
    }

    card:hover {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
    }

    h5{
        margin-bottom:1rem;
    }


    .carousel-caption{
        padding: 0;
        bottom: 0;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-item > img{
        height: 25rem;
        object-fit: cover;
    }

    .carousel-fade .carousel-item {
        opacity: 0;
        transition-duration: .6s;
        transition-property: opacity
    }

    .carousel-fade .carousel-item-next.carousel-item-left,.carousel-fade .carousel-item-prev.carousel-item-right,.carousel-fade .carousel-item.active {
        opacity: 1
    }

    .carousel-fade .active.carousel-item-left,.carousel-fade .active.carousel-item-right {
        opacity: 0
    }

    .carousel-fade .active.carousel-item-left,.carousel-fade .active.carousel-item-prev,.carousel-fade .carousel-item-next,.carousel-fade .carousel-item-prev,.carousel-fade .carousel-item.active {
        -webkit-transform: translateX(0);
        transform: translateX(0)
    }

    @supports ((-webkit-transform-style: preserve-3d) or (transform-style:preserve-3d)) {
        .carousel-fade .active.carousel-item-left,.carousel-fade .active.carousel-item-prev,.carousel-fade .carousel-item-next,.carousel-fade .carousel-item-prev,.carousel-fade .carousel-item.active {
            -webkit-transform:translate3d(0,0,0);
            transform: translate3d(0,0,0)
        }
    }
</style>
<div class="container mundb-standard-container">
    <section class="mb-5">
        <h1 class="mb-3"><i class="MDI checkbox-marked-circle-outline"></i> 活动报名</h1>
        <hr class="atsast-line mb-5">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <contest>
                    <div class="atsast-img-container-small">
                        <img src="{{$basic_info['image']}}">
                    </div>
                    <div class="atsast-content-container">
                        <h3 class="mundb-text-truncate-2">{{$basic_info['name']}}</h3>
                        <p class="mundb-text-truncate-1">{{$basic_info['creator_name']}} ·@if($basic_info['type']==1) 线上活动@else 线下活动@endif</p>
                        <p class="mundb-text-truncate-1"><i class="MDI clock"></i> {{$basic_info['parse_date']}} </p>
                    </div>
                </contest>
            </div>
            <div class="col-md-8 col-sm-12">
                @if($maxp > 1)
                    <card>
                        <h5><i class="MDI account-multiple"></i> 团队信息</h5> 
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating">队伍名*</label>
                            <input type="text" class="form-control" name="group_name" value="{{$group_name}}" id="group_name" required @if($registered) disabled @endif>
                        </div>
                    </card>
                @endif
                @foreach($members as $order=>$member)
                    <card>
                        @if($maxp > 1) <h5><i class="MDI @if($order==0) account-star @else account @endif"></i>@if($order==0) 队长信息@else 队员信息@endif @if($order >= $minp)（选填）@endif</h5> @else <h5><i class="MDI account-circle"></i> 个人信息</h5> @endif
                        @foreach($fields as $field)
                        <div class="form-group">
                            <label for="name" class="bmd-label-floating">{{$field['placeholder']}}@if($field['required'] && $order < $minp)*@endif</label>
                            <input type="text" class="form-control" name="{{$field['name']}}_{{$order}}" value="{{$member[$field['name']]}}" id="{{$field['name']}}_{{$order}}"@if($field['required'] && $order < $minp) required @endif @if($field['fixed'] && $order == 0 || $registered) disabled @endif>
                        </div>
                        @endforeach
                    </card>
                @endforeach
                    <card>
                        <h5 class="text-center"><i class="MDI information"></i> 其他信息</h5>
                        <p class="text-center">请确认上述填写信息均为准确信息，然后点击下方的提交按钮。</p>
                        <p class="text-center">{{$basic_info['tips']}}</p>
                        <div class="text-center">
                            <button onclick="@if($registered) @if($isleader) edit() @else @endif @else submit() @endif" data-hid="3" id="btn_submit_3" class="btn btn-outline-primary">@if($registered) @if($isleader) 修改报名信息 @else 修改报名信息请联系队长 @endif @else 提交 @endif<div class="ripple-container"></div></button>
                        </div>
                    </card>
            </div>
        </div>
    </section>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modeal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modeal_desc"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        function submit() {
            var $inputs = $("card input");
            var data = { contest_id: {{$coid}} };
            for (var i = 0; i < $inputs.length; ++i) {
                var input = $inputs[i];
                if (input.id == 'group_name') data['group_name'] = input.value;
                else {
                    var off = input.id.lastIndexOf('_');
                    var name = input.id.substr(0, off);
                    var order = input.id.substr(off + 1);
                    if (data[order] == undefined) data[order] = {};
                    data[order][name] = input.value;
                }
                if (input.required && input.value == "") {
                    alert("请填写所有应填项");
                    return;
                }
            }
            $.post("/ajax/contest/register", data, function (data, status) {
                data = JSON.parse(data);
                alert(data.desc);
                if (data.data != null) setTimeout(function () { return location.href = data.data; }, 1000);
                // 这段注释用来纪念刁老板被祭天
            }).fail(function (req) {
                alert("发生错误");
            });
        }
        function edit() {
            $("card input[id!=\"SID_0\"]").removeAttr("disabled");
            var btn = $("#btn_submit_3")[0];
            btn.innerText = "提交修改";
            btn.onclick = submit;
        }
    </script>
</div>

@endsection