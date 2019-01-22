@extends('emails.emailheader')

@section('content')
    <div class="container">
        <p>{{ $messages['volunteer_approved_email'] }}</p>
        <p>{{ $messages['volunteer_approved_email_thank_you'] }}</p>
        <p>Your Request: </p>
        <p>Event Date: {{$form['event_date_time']}}</p>
        <p>Meal Description: {{$form['meal_description']}}</p>
        <p>Contact Email: {{$form['email']}} </p>
        <p>Contact Phone: {{$form['phone']}} </p>
        <p>Will provide paper goods: {{$form['paper_goods'] ? 'yes' : 'no'}} </p>
    </div>
@endsection
