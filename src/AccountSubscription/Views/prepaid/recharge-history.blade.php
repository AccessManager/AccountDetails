@extends("AccountSubscription::prepaid.layout")

@section('tab-content')
<table class="table table-hover table-stripped">
    <thead>
        <tr>
            <th>
                sr no.
            </th>
            <th>
                plan name
            </th>
            <th>
                validity
            </th>
            <th>
                recharged on
            </th>
            <th>
                method
            </th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $vouchers->firstItem(); ?>
    @forelse($vouchers as $voucher)
        <tr>
            <td>
                {{$i++}}
            </td>
            <td>
                {{$voucher->plan_name}}
            </td>
            <td>
                {{$voucher->validity}} {{$voucher->validity_unit}}
            </td>
            <td>
                {{$voucher->used_on->format('d M y H:i:s')}}
            </td>
            <td>
                {{$voucher->method}}
            </td>
        </tr>
    @empty

    @endforelse
    </tbody>
</table>
    <span class="pull-right">
        {{$vouchers->links()}}
    </span>
@endsection