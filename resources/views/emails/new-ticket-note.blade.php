<h3>Hi {{$user->name}}</h3>

<h4>A new ticket note has been added to Ticket Number: {{$ticket->id}}</h4>

<p><b>Note:</b> {!!$ticketEntry->note!!}</p>

<hr>

<h3>Ticket Details</h3>
<h4>Subject: {{$ticket->subject}}</h4>
<p>Description: {!!$ticket->description!!}</p>

<hr>

<a href="{{url('/tickets')}}/{{$ticket->id}}">View The Ticket Online</a>
