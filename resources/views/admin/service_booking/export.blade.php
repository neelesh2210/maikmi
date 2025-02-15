<table>
    <thead>
        <tr>
            <th><b>Booking Id</b></th>
            <th><b>Salon Name</b></th>
            <th><b>Service Name</b></th>
            <th><b>Total Amount</b></th>
            <th><b>Booking Date</b></th>
            <th><b>Booking Time</b></th>
            <th><b>Status</b></th>
            <th><b>User Name</b></th>
            <th><b>Cancel Reason</b></th>
            <th><b>Remark</b></th>
            <th><b>Booked Date</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$data)
            <tr>
                <td>{{$data->booking_id}}</td>
                <td>{{$data->getSalon->name}}</td>
                <td>
                    @foreach ($data->service??[] as $service)
                        {{$service['name']}},
                    @endforeach
                </td>
                <td>{{$data->total_amount}}</td>
                <td>{{$data->booking_date}}</td>
                <td>{{$data->booking_time}}</td>
                <td>{{$data->status}}</td>
                <td>{{$data->getBookedBy->name}}</td>
                <td>{{$data->cancel_reason}}</td>
                <td>{{$data->remark}}</td>
                <td>{{$data->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
