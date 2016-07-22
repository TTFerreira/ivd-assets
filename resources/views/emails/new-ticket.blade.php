<h3>Hi {{$user->name}}</h3>

<h4>A new ticket has been logged. Ticket Number: {{$ticket->id}}</h4>

<h3>Ticket Details</h3>
<h4>Subject: {{$ticket->subject}}</h4>
<p>Description: {!!$ticket->description!!}</p>

<hr>

<ul>
  <li>Logged by: {{$ticket->user->name}}</li>
  <li>Location: {{$ticket->location->location_name}}</li>
  <li>Status: {{$ticket->ticket_status->status}}</li>
  <li>Type: {{$ticket->ticket_type->type}}</li>
  <li>Priority: {{$ticket->ticket_priority->priority}}</li>
</ul>

<hr>

<a href="{{url('/tickets')}}/{{$ticket->id}}">View The Ticket Online</a>
