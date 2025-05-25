@extends('admin.layouts.layout')
@section('title_admin')
    ConnectingNotes | Admin
@endsection
@section('admin_layout')
    <div class="container">
        <h2 class="font-bold font-3xl">Archived Seller Forms</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivedForms as $form)
                    <tr>
                        <td>{{ $form->user->full_name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($form->status) }}</td>
                        <td>{{ $form->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection