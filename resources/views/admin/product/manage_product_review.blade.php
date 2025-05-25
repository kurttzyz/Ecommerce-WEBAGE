@extends('admin.layouts.layout')
@section('title_admin')
    ConnectingNotes | Admin
@endsection
@section('admin_layout')


    <div class="container">
       <h2 class="text-3xl font-bold">Achievements Overview</h2>




        {{-- Table with Delete --}}
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Progress</th>
                    <th>Issued By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($achievements as $a)
                    @foreach($a->users as $user)
                        <tr>
                            <td>{{ $a->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->pivot->progress}}%</td>
                            <td>{{ $a->issued_by }}</td>
                            <td>

                                    <a href="{{ route('achievements.show', ['achievement' => $a->id, 'user' => $user->id]) }}"
                                        class="btn btn-info btn-sm">View</a>


                            </td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    </div>


@endsection

