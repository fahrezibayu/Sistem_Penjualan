<table id="data_id" class=" table table-md table-bordered table-striped">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Tanggal Login</th>
        <th>Jam Login</th>
        <th>Jam Logout</th>
        <th>Status</th>
    </tr>
    @php
        $no = 0;
    @endphp
    @foreach ($sql as $d)
    @php
        $no++;
    @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $d->tb_user->username }}</td>
            <td>{{ $d->tanggal_in }}</td>
            <td>{{ $d->jamin }}</td>
            <td>{{ $d->jamout }}</td>
            <td>{{ $d->status }}</td>
        </tr>
    @endforeach
</table>
