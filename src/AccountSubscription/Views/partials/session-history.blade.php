<table class="table table-hover table-stripped">
    <thead>
    <tr>
        <th>Start Time</th>
        <th>Stop Time</th>
        <th>Duration</th>
        <th>Download</th>
        <th>Upload</th>
        <th>Total Data Transfer</th>
        <th>IP Address</th>
        <th>MAC Addres</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = $sessions->firstItem(); ?>
    @forelse($sessions as $session)
        <tr>
            <td>
                {{(new \Carbon\Carbon($session->acctstarttime))->format('d M\'y H:i')}}
            </td>
            <td>
                {{(new \Carbon\Carbon($session->acctstoptime))->format('d M\'y H:i')}}
            </td>
            <td>
                {{\AccessManager\Helpers\Format::secondsToReadable($session->acctsessiontime)}}
            </td>
            <td>
                {{\AccessManager\Helpers\Format::bytesToReadable($session->acctinputoctets)}}
            </td>
            <td>
                {{\AccessManager\Helpers\Format::bytesToReadable($session->acctoutputoctets)}}
            </td>
            <td>
                {{\AccessManager\Helpers\Format::bytesToReadable($session->acctinputoctets + $session->acctoutputoctets)}}
            </td>
            <td>
                {{$session->framedipaddress}}
            </td>
            <td>
                {{$session->callingstationid}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8"> no records found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="pull-right">
    {{$sessions->links()}}
</div>