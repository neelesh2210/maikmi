<table>
    <thead>
        <tr>
            <th><b>User Unique Id</b></th>
            <th><b>Name</b></th>
            <th><b>Email</b></th>
            <th><b>Phone</b></th>
            <th><b>Referrer Code</b></th>
            <th><b>Salon Unique Id</b></th>
            <th><b>Salon Name</b></th>
            <th><b>Salon Phone Number</b></th>
            <th><b>City</b></th>
            <th><b>Address</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$data)
            <tr>
                <td>{{$data->getOwner->user_unique_id}}</td>
                <td>{{$data->getOwner->name}}</td>
                <td>{{$data->getOwner->email}}</td>
                <td>{{$data->getOwner->phone}}</td>
                <td>{{$data->getOwner->referrer_code}}</td>
                <td>{{$data->salon_unique_id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->phone_number}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->address}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
