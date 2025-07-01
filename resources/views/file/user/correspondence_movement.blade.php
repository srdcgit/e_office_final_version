@extends('layouts.fileLayout')
@section('file_title', 'Correspondence Movements')
@section('file_content')
    <h3>Correspondence Movements</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Correspondence IDs</th>
                <th>Remark</th>
                <th>Moved By</th>
                <th>Moved At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $movement)
                <tr>
                    <td>{{ implode(', ', $movement->correspondence_ids) }}</td>
                    <td>{{ $movement->remark }}</td>
                    <td>{{ $movement->user->name ?? 'N/A' }}</td>
                    <td>{{ $movement->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection