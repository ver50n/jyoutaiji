<section class="timeline">
  <ul>
    @foreach($histories as $history)
    <li>
      <div>
        <time>{{ $history->timeline_tag }}</time>
        {{ $history->event_tag }}
      </div>
    </li>
    @endforeach
  </ul>
</section>