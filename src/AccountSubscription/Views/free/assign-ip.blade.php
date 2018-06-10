@extends("AccountSubscription::free.layout")
@section('tab-content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h5 class="text-muted">
                Assign Static IP
            </h5>
            <hr>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    {!! Form::open(['route'=>['account.subscriptions.free.assign-ip.post', request()->segment(2), request()->segment(4)],
            'class'=>'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-10">
                                {!! Form::select('network_subnet_id', $subnets, null, ['class'=>'form-control', 'id'=>'subnet']) !!}
                            </div>
                        </div>
                        <div class="form-group hidden" id="ip-div">
                            <div class="col-xs-10">
                                <select name="framed_ip" id="ip-list" class="form-control">
                                    <option value="0">
                                        Select IP
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-4 col-xs-offset-4">
                                {!! Form::submit('Assign', ['class'=>'btn btn-flat btn-info']) !!}
                            </div>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push("javascripts")
    <script>
        $(function(){
            $('#subnet').on('change',function(){
                var subnet_id = $(this).val();
                var ip_div = $('#ip-div');
                var ip_list = $('#ip-list');
                var promise = $.ajax({
                    url : "{!! route('subnet.ip.json') !!}/" + subnet_id,
                    method : 'GET',
                }).promise();
                promise.done(function(result){
                    if( ! $.isEmptyObject(result) ) {
                        ip_div.removeClass('hidden');
                        ip_list.empty();
                        $.each(result, function(key, value){
                            ip_list.append("<option value='"+key+"'>"+value+"</option>");
                            ip_list.selectpicker('refresh');
                        });
                    } else {
                        ip_div.addClass('hidden');
                        ip_list.val(0);
                    }
                });
            });
        });
    </script>
@endpush