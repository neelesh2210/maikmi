<table>
    <thead>
        <tr>
            <th><b>User Unique Id</b></th>
            <th><b>Name</b></th>
            <th><b>Email</b></th>
            <th><b>Phone</b></th>
            <th><b>Referrer Code</b></th>
            <th><b>DOB</b></th>
            <th><b>Gender</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$data)
            <tr>
                <td>{{$data->user_unique_id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->referrer_code}}</td>
                <td>{{$data->userDetail->dob}}</td>
                <td>{{$data->userDetail->gender}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
