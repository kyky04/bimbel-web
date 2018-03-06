<table class="table table-responsive" id="kursuses-table">
    <thead>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Alamat</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($kursuses as $kursus)
        <tr>
            <td>{!! $kursus->nama !!}</td>
            <td>{!! $kursus->kategori !!}</td>
            <td>{!! $kursus->alamat !!}</td>
            <td>{!! $kursus->longitude !!}</td>
            <td>{!! $kursus->latitude !!}</td>
            <td>
                {!! Form::open(['route' => ['kursuses.destroy', $kursus->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('kursuses.show', [$kursus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('kursuses.edit', [$kursus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>